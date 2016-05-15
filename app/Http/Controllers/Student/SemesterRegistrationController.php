<?php

namespace App\Http\Controllers\Student;

use App;
use App\Grade;
use App\Hostel;
use App\Course;
use App\Http\Requests;
use App\ElectiveCount;
use App\TeacherRequest;
use App\AllocatedElective;
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
    protected $registrationFormView = 'student.semesterRegistration.registrationForm';

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
     * Get the current state of student
     *
     * @return CurrentStudentState
     */
    protected function getCurrentStudentState ()
    {
        $currentStudentState = CurrentStudentState::find(Auth::guard('student')->user()->rollNo);

        return $currentStudentState;
    }

    //------------------------------------------------------------------------------------------------------------------
    // Functions for managing step one (initial details step) of registration

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

    //------------------------------------------------------------------------------------------------------------------
    // Functions for managing step two (fee and hostel details) of registration

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

    //------------------------------------------------------------------------------------------------------------------
    // Functions for managing step three (course review and elective allocation) of registration

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

        // Get the regular courses
        $courses = Course::where([
            'dCode' => Auth::guard('student')->user()->dCode,
            'semNo' => $this->getCurrentStudentState()->semNo,
            'openElective' => false,
            'departmentElective' => false,
        ])->get();

        // Get the open electives
        $openElectives = Course::where('dCode', '!=', Auth::guard('student')->user()->dCode)
            ->where([
                'semNo' => $this->getCurrentStudentState()->semNo,
                'openElective' => true,
            ])->get();

        // Get the department electives
        $departmentElectives = Course::where([
            'dCode' => Auth::guard('student')->user()->dCode,
            'semNo' => $this->getCurrentStudentState()->semNo,
            'departmentElective' => true,
        ])->get();

        // Get the elective count
        $electiveCount = ElectiveCount::where([
            'dCode' => Auth::guard('student')->user()->dCode,
            'semNo' => $this->getCurrentStudentState()->semNo,
        ])->get();

        return view($this->courseDetailsView, [
            'courses' => $courses, 'count' => 0,
            'electiveCount' => $electiveCount,
            'openElectives' => $openElectives,
            'departmentElectives' => $departmentElectives,
        ]);
    }

    /**
     * Allocate department/open elective subjects to the students
     *
     * @param Request $request
     */
    public function allocateElectives (Request $request)
    {
        $currentStudentState = $this->getCurrentStudentState();

        if($request->has('courseCode'))
        {
            $this->validate($request, ['courseCode' => 'required']);

            $courseCode = $request['courseCode'];

            // Get the elective count
            $electiveCount = ElectiveCount::where([
                'dCode' => Auth::guard('student')->user()->dCode,
                'semNo' => $this->getCurrentStudentState()->semNo,
            ])->get();

            $totalElectives = $electiveCount[0]->openElectives + $electiveCount[0]->departmentElectives;

            // Validate that no two electives are same
            $courseCount = array_count_values($courseCode);
            
            for($no = 0; $no < $totalElectives; $no++)
            {
                if($courseCount[$courseCode[$no]] > 1)
                {
                    return redirect()->back()
                        ->with('status', 'Please don not choose identical electives');
                }
            }


            // Check if seats are available in the chosen electives
            for($no = 0; $no < $totalElectives; $no++)
            {
                $maxStrength = 90;
                $currentStrength = AllocatedElective::where('courseCode', $courseCode[$no])->count();

                if($currentStrength >= $maxStrength)
                {
                    return redirect()->back()
                        ->with('status', 'Sorry, elective ' . $courseCode[$no] . ' is not having any vacant seats. Please choose another one.');
                }
            }

            // Allocate the electives to student
            for($no = 0; $no < $totalElectives; $no++)
            {
                AllocatedElective::create([
                    'rollNo' => Auth::guard('student')->user()->rollNo,
                    'courseCode' => $courseCode[$no],
                ]);
            }
        }

        $currentStudentState->step = 3;
        $currentStudentState->save();

        // Now redirect to the status view
        return redirect('/students/semesterRegistration/status');
    }

    /**
     * Get elective strength info
     *
     * @param $courseCode
     * @return int
     */
    public function getElectiveInfo ($courseCode)
    {
        $maxStrength = 90;
        $currentStrength = AllocatedElective::where('courseCode', $courseCode)->count();
        $availableSeats = $maxStrength - $currentStrength;

        return $availableSeats;
    }

    //------------------------------------------------------------------------------------------------------------------
    // Functions for showing registration status to student and downloading of registration form

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
        $allocatedElectives = AllocatedElective::where('rollNo', Auth::guard('student')->user()->rollNo)->get();

        return view($this->registrationStatusView, [
            'currentStudentState' => $currentStudentState,
            'allocatedElectives' => $allocatedElectives,
            'count' => 0
        ]);
    }

    /**
     * Get the registration form in PDF document
     *
     * @return string
     */
    public function getRegistrationForm ()
    {
        if (Auth::guard('student')->user()->currentStudentState->approved == false)
        {
            return redirect()->back();
        }

        // Get the regular courses
        $courses = Course::where([
            'dCode' => Auth::guard('student')->user()->dCode,
            'semNo' => $this->getCurrentStudentState()->semNo,
            'openElective' => false,
            'departmentElective' => false,
        ])->get();

        // Get electives if any
        $allocatedElectives = AllocatedElective::where('rollNo', Auth::guard('student')->user()->rollNo)->get();
        
        $count = 0;
        
        $registrationForm = App::make('snappy.pdf.wrapper');
        $registrationForm->loadView($this->registrationFormView, [
            'courses' => $courses,
            'allocatedElectives' => $allocatedElectives,
            'count' => $count
        ])->setOption('margin-bottom', 10)->setOption('margin-top', 10);
        
        return $registrationForm->download(Auth::guard('student')->user()->rollNo . 'form.pdf');
    }
}