<?php

namespace App\Http\Controllers\Student;

use App\Grade;
use App\Hostel;
use App\Course;
use App\Http\Requests;
use App\TeacherRequest;
use App\AdminStaffRequest;
use App\HostelStaffRequest;
use Illuminate\Http\Request;
use App\CurrentStudentState;
use App\LibraryStaffRequest;
use App\ChiefWardenStaffRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

/**
 * Class SemesterRegistrationController, this class contains
 * the logic for the semester registration of student
 *
 * @package App\Http\Controllers\Student
 */
class SemesterRegistrationController extends Controller
{
    // Views for registration steps
    protected $initialDetailsView = 'student.semesterRegistration.initialDetails';
    protected $courseDetailsView = 'student.semesterRegistration.courseDetails';
    protected $registrationStatusView = 'student.semesterRegistration.registrationStatus';
    protected $feeAndHostelDetailsView = 'student.semesterRegistration.feeAndHostelDetails';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:student');
        $this->middleware('verify:student');
        $this->middleware('noImage');
    }

    /**
     * Validate the request
     *
     * @param Request $request
     */
    protected function validateRequest (Request $request)
    {
        $rules = [
            'semNo' => 'required|numeric|max:10|min:' . (Auth::guard('student')->user()->semNo + 1),
            'hostler' => 'required',
            'feeReceipt' => 'required',
        ];

        $errorMessages = [
            'min' => 'Please choose a semester that is greater than your last semester.',
        ];

        for ($semNo = 0; $semNo < Auth::guard('student')->user()->semNo; $semNo++)
        {
            // Validation rules
            $rules['sgpi.' . $semNo] = 'required|numeric|min:0|max:10';
            $rules['cgpi.' . $semNo] = 'required|numeric|min:0|max:10';
            $rules['suppliemntaries.' . $semNo] = 'max:200';

            // Validation error messages
            $errorMessages['sgpi.'. $semNo . '.min'] = 'The sgpi  for semester ' . ($semNo + 1) . ' must be atleast 0';
            $errorMessages['cgpi.'. $semNo . '.min'] = 'The cgpi  for semester ' . ($semNo + 1) . ' must be atleast 0';
            $errorMessages['sgpi.'. $semNo . '.max'] = 'The sgpi  for semester ' . ($semNo + 1) . ' must be less than 10';
            $errorMessages['cgpi.'. $semNo . '.max'] = 'The cgpi  for semester ' . ($semNo + 1) . ' must be less than 10';
            $errorMessages['sgpi.'. $semNo . '.numeric'] = 'The sgpi  for semester ' . ($semNo + 1) . ' must be a valid number';
            $errorMessages['cgpi.'. $semNo . '.numeric'] = 'The cgpi  for semester ' . ($semNo + 1) . ' must be a valid number';
        }

        $this->validate($request, $rules, $errorMessages);
    }

    /**
     * Add student grades and supplementaries in the table
     *
     * @param Request $request
     */
    protected function addGrades (Request $request)
    {
        for ($semNo = 0; $semNo < Auth::guard('student')->user()->semNo; $semNo++)
        {
            $grade = Grade::firstOrNew([
                'rollNo' => Auth::guard('student')->user()->rollNo,
                'semNo' => $semNo + 1,
            ]);

            $grade->sgpi = $request['sgpi'][$semNo];
            $grade->cgpi = $request['cgpi'][$semNo];
            $grade->supplementaries = (strlen($request['supplementaries'][$semNo]) > 0) ? $request['supplementaries'][$semNo] : null;

            $grade->save();
        }
    }

    /**
     * Show the initial details view to the student
     *
     * @return mixed
     */
    public function showInitialDetailsView ()
    {
        if(!$this->isRegistrationActive('student'))
        {
            return view($this->inactiveView);
        }

        return view($this->initialDetailsView);
    }

    /**
     * Add initial details of student
     *
     * @param Request $request
     */
    public function addInitialDetails (Request $request)
    {
        if(!$this->isRegistrationActive('student'))
        {
            return view($this->inactiveView);
        }

        $this->validateRequest($request);

        $data = [
            'rollNo' => Auth::guard('student')->user()->rollNo,
            'semNo' => $request['semNo'],
            'feeReceipt' => ($request['feeReceipt'] == 'yes') ? true : false,
            'hostler' => ($request['hostler'] == 'yes') ? true : false,
        ];

        // Insert the details into database
        $this->addGrades($request);
        $currentStudentState = CurrentStudentState::firstOrNew(['rollNo' => $data['rollNo']]);
        $currentStudentState->feeReceipt = $data['feeReceipt'];
        $currentStudentState->hostler = $data['hostler'];
        $currentStudentState->semNo = $data['semNo'];
        $currentStudentState->approved = false;
        $currentStudentState->step = 1;
        $currentStudentState->save();
        
        // Now redirect to next step
        return redirect('/students/semesterRegistration/feeAndHostelDetails');
    }

    /**
     * Get the current state of student
     *
     * @return CurrentStudentState
     */
    protected function getCurrentStudentState ()
    {
        $currentStudentState = CurrentStudentState::find(Auth::guard('student')->user()->rollNo);
        
        return $currentStudentState;
    }

    /**
     * Show hostel and feel details view to the student
     *
     * @return mixed
     */
    public function showFeeAndHostelDetailsView ()
    {
        if(!$this->isRegistrationActive('student'))
        {
            return view($this->inactiveView);
        }

        $currentStudentState = $this->getCurrentStudentState();

        // Get the list of hostels
        $hostels = Hostel::all();

        return view($this->feeAndHostelDetailsView, ['currentStudentState' => $currentStudentState,
            'hostels' => $hostels]);
    }

    /**
     * Add fee and hostel details of the student and
     * send the corresponding approval requests
     *
     * @param Request $request
     * @return mixed
     */
    public function addFeeAndHostelDetails (Request $request)
    {
        $currentStudentState = $this->getCurrentStudentState();

        /*
         * Check if the fee receipt image is present. If present, then upload
         * the image and send the approval request to the teacher, otherwise
         * send the approval request to accounts branch for verification
         */
        if($request->hasFile('image'))
        {
            $this->validate($request, [
                'image' => 'image|required|max:2048',
            ], [
                'image' => 'The file must be a valid image file.'
            ]);

            if ($request->file('image')->isValid())
            {
                $image = $request->file('image');
                $rollNo = Auth::guard('student')->user()->rollNo;

                // Set the image parameters
                $imageQuality = 70;
                $imagePath = env('IMAGE_DIR') . '/feeReceipts/' . $rollNo . '.jpg';

                // Save the image
                Image::make($image->getRealPath())
                    ->save($imagePath, $imageQuality);

                /*
                 * Update the image path in the database
                 * and send the request to the teacher
                 */
                TeacherRequest::create([
                    'rollNo' => Auth::guard('student')->user()->rollNo,
                    'semNo' => $currentStudentState->semNo,
                    'status' => 'new',
                    'imagePath' => $imagePath,
                ]);
            }
            else
            {
                return redirect()->back()
                    ->withErrors('Upload unsuccessful!!!');
            }
        }
        else
        {
            // Send the request to accounts branch
            AdminStaffRequest::create([
                'rollNo' => Auth::guard('student')->user()->rollNo,
                'status' => 'new',
            ]);
        }

        /*
         * Check if the hostelId is present. If present, then send the approval request to the
         * concerned hostel, otherwise send the approval request to chief warden office
         */
        if ($request->has('hostelId'))
        {
            $currentStudentState->hostelId = $request['hostelId'];
            $currentStudentState->save();

            // Send the request to the concerned hostel
            HostelStaffRequest::create([
                'rollNo' => Auth::guard('student')->user()->rollNo,
                'hostelId' => $request['hostelId'],
                'status' => 'new',
            ]);
        }
        else
        {
            // Send the request to chief warden office for approval
            ChiefWardenStaffRequest::create([
                'rollNo' => Auth::guard('student')->user()->rollNo,
                'status' => 'new',
            ]);
        }

        // Send the request to library for approval
        LibraryStaffRequest::create([
            'rollNo' => Auth::guard('student')->user()->rollNo,
            'status' => 'new',
        ]);

        $currentStudentState->step = 2;
        $currentStudentState->save();

        // Now redirect to next step
        return redirect('/students/semesterRegistration/courseDetails');
    }

    /**
     * Re-upload the fee receipt of student
     *
     * @param Request $request
     * @return mixed
     */
    public function reUploadFeeReceipt (Request $request)
    {
        if($request->hasFile('image'))
        {
            $this->validate($request, [
                'image' => 'image|required|max:2048',
            ], [
                'image' => 'The file must be a valid image file.'
            ]);

            if ($request->file('image')->isValid())
            {
                $image = $request->file('image');
                $rollNo = Auth::guard('student')->user()->rollNo;

                // Set the image parameters
                $imageQuality = 70;
                $imagePath = env('IMAGE_DIR') . '/feeReceipts/' . $rollNo . '.jpg';

                // Save the image
                Image::make($image->getRealPath())
                    ->save($imagePath, $imageQuality);

                // Update the request status
                TeacherRequest::where(['rollNo' => Auth::guard('student')->user()->rollNo])
                    ->update(['status' => 'new', 'remarks' => null]);

                return redirect()->back()
                    ->with('success');
            }
            else
            {
                return redirect()->back()
                    ->withErrors('Upload unsuccessful!!!');
            }
        }
    }

    /**
     * Show course details view to the student
     *
     * @return mixed
     */
    public function showCourseDetailsView ()
    {
        if(!$this->isRegistrationActive('student'))
        {
            return view($this->inactiveView);
        }

        // Get the courses
        $courses = Course::where([
            'dCode' => Auth::guard('student')->user()->dCode,
            'semNo' => $this->getCurrentStudentState()->semNo,
        ])->get();

        return view($this->courseDetailsView, ['courses' => $courses, 'count' => 0]);
    }

    /**
     * Add course details of the student
     *
     * @param Request $request
     */
    public function addCourseDetails (Request $request)
    {
        $currentStudentState = $this->getCurrentStudentState();

        // #TODO open elective allocation logic to go here
        // #TODO department elective allocation logic to go here

        $currentStudentState->step = 3;
        $currentStudentState->save();

        // Now redirect to the status view
        return redirect('/students/semesterRegistration/status');
    }

    /**
     * Show registration status to the student
     *
     * @return mixed
     */
    public function showRegistrationStatusView ()
    {
        if(!$this->isRegistrationActive('student'))
        {
            return view($this->inactiveView);
        }

        $currentStudentState = $this->getCurrentStudentState();

        return view($this->registrationStatusView, ['currentStudentState' => $currentStudentState]);
    }
}