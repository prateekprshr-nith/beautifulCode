<?php

namespace App\Http\Controllers\Teacher;

use App\Course;
use App\Student;
use App\Teacher;
use App\Http\Requests;
use App\ElectiveCount;
use App\TeacherRequest;
use Illuminate\Http\Request;
use App\CurrentStudentState;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

/**
 * Class SemesterRegistrationController, this class contains
 * all the logic for student semester registration process
 * 
 * @package App\Http\Controllers
 */
class SemesterRegistrationController extends Controller
{
    // Views dealing with semester registration
    protected $semesterSelectionView = 'teacher.semesterRegistration.semester';
    protected $courseSelectionView = 'teacher.semesterRegistration.courses';
    protected $newRequestsView = 'teacher.semesterRegistration.newRequests';
    protected $pendingRequestsView = 'teacher.semesterRegistration.pendingRequests';
    protected $approvedRequestsView = 'teacher.semesterRegistration.approvedRequests';
    protected $allRequestsView = 'teacher.semesterRegistration.allRequests';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->middleware('firstLogin:teacher');
    }

    //------------------------------------------------------------------------------------------------------------------
    // Registration as an incharge and course management functions

    /**
     * Show semester selection view
     * 
     * @return mixed
     */
    public function showSemesterSelectionView()
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        // Get elective count
        $electiveCount = ElectiveCount::where([
            'dCode' => Auth::guard('teacher')->user()->dCode,
            'semNo' => Auth::guard('teacher')->user()->semNo,
        ])->get();

        return view($this->semesterSelectionView, ['electiveCount' => $electiveCount]);
    }

    /**
     * Show course selection view
     *
     * @return mixed
     */
    public function showCourseSelectionView ()
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        // Get the semester
        $semNo = Auth::guard('teacher')->user()->semNo;

        /*
         * Check if the semeseter is null. If it
         * is null, then course selection form
         * should be in-active and semester
         * selection form should be active
         */
        if($semNo === null)
        {
            return redirect('/teachers/semesterRegistration/semester');
        }
        else
        {
            // Get the courses
            $courses = Course::where([
                'dCode' => Auth::guard('teacher')->user()->dCode,
                'semNo' => $semNo,
            ])->get();
            
            // Get elective count
            $electiveCount = ElectiveCount::where([
                'dCode' => Auth::guard('teacher')->user()->dCode,
                'semNo' => $semNo,
            ])->get();

            return view($this->courseSelectionView, [
                'courses' => $courses,
                'electiveCount' => $electiveCount,
                'count' => 0,
            ]);
        }
    }

    /**
     * Add elective counts
     *
     * @param Request $request
     * @return mixed
     */
    public function addElectiveCounts (Request $request)
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        $this->validate($request,[
            'openElectives' => 'required|min:0',
            'departmentElectives' => 'required|min:0',
        ]);

        $data = [
            'dCode' => Auth::guard('teacher')->user()->dCode,
            'semNo' => Auth::guard('teacher')->user()->semNo,
            'openElectives' => $request['openElectives'],
            'departmentElectives' => $request['departmentElectives'],
        ];

        // Insert into databse
        $electiveCount = ElectiveCount::where([
            'dCode' => Auth::guard('teacher')->user()->dCode,
            'semNo' => Auth::guard('teacher')->user()->semNo,
        ])->get();

        if(count($electiveCount) > 0)
        {
            ElectiveCount::where([
                'dCode' => Auth::guard('teacher')->user()->dCode,
                'semNo' => Auth::guard('teacher')->user()->semNo,
            ])->delete();

            ElectiveCount::create($data);
        }
        else
        {
            ElectiveCount::create($data);
        }

        return redirect()->back()
            ->with('status', 'Updated Successfully');
    }

    /**
     * Set / update teachers semester
     *
     * @param Request $request
     * @return mixed
     */
    public function addSemester (Request $request)
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        $this->validate($request, [
            'semNo' => 'required|numeric|min:1|unique:teachers,semNo,NULL,id,dCode,' . Auth::guard('teacher')->user()->dCode,
        ], [
            'unique' => 'This semester is already allocated'
        ]);

        $semNo = $request['semNo'];

        $teacher = Teacher::find(Auth::guard('teacher')->user()->facultyId);
        $teacher->semNo = $semNo;
        $teacher->save();

        return redirect()->back();
    }

    //------------------------------------------------------------------------------------------------------------------
    // Student registration requests management functions

    /**
     * Get request counts
     *
     * @return mixed
     */
    protected function getRequestCounts ()
    {
        $countArr['newCount'] = count(TeacherRequest::where([
            'semNo' => Auth::guard('teacher')->user()->semNo,
            'status' => 'new',
        ])->get());
        $countArr['pendingCount'] = count(TeacherRequest::where([
            'semNo' => Auth::guard('teacher')->user()->semNo,
            'status' => 'pending',
        ])->get());
        $countArr['approvedCount'] = count(TeacherRequest::where([
            'semNo' => Auth::guard('teacher')->user()->semNo,
            'status' => 'approved',
        ])->get());
        $countArr['totalCount'] = count(CurrentStudentState::where(['semNo' => Auth::guard('teacher')->user()->semNo])
            ->get());

        return $countArr;
    }

    /**
     * Show new requests view
     *
     * @return mixed
     */
    public function showNewRequestsView ()
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        // Get the requests
        $requests = TeacherRequest::where([
            'semNo' => Auth::guard('teacher')->user()->semNo,
            'status' => 'new',
        ])->get();

        $requestCount = $this->getRequestCounts();

        return view($this->newRequestsView, ['requests' => $requests, 'count' => 0,  'requestCount' => $requestCount]);
    }

    /**
     * Show pending requests view
     *
     * @return mixed
     */
    public function showPendingRequestsView ()
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        // Get the requests
        $requests = TeacherRequest::where([
            'semNo' => Auth::guard('teacher')->user()->semNo,
            'status' => 'pending',
        ])->get();

        $requestCount = $this->getRequestCounts();

        return view($this->pendingRequestsView, ['requests' => $requests, 'count' => 0,  'requestCount' => $requestCount]);
    }

    /**
     * Show approved requests view
     *
     * @return mixed
     */
    public function showApprovedRequestsView ()
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        // Get the requests
        $requests = TeacherRequest::where([
            'semNo' => Auth::guard('teacher')->user()->semNo,
            'status' => 'approved',
        ])->get();

        $requestCount = $this->getRequestCounts();

        return view($this->approvedRequestsView, ['requests' => $requests, 'count' => 0,  'requestCount' => $requestCount]);
    }

    /**
     * Show all requests view
     *
     * @return mixed
     */
    public function showAllRequestsView ()
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        // Get the student list
        $requests = CurrentStudentState::where([
            'semNo' => Auth::guard('teacher')->user()->semNo,
        ])->get();

        $requestCount = $this->getRequestCounts();

        return view($this->allRequestsView, ['requests' => $requests, 'count' => 0,  'requestCount' => $requestCount]);
    }

    /**
     * Get the fee receipt of a student
     *
     * @param $rollNo
     */
    public function getFeeReceiptImage ($rollNo)
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        // Get the fee receipt image and
        // return it as http response
        $imagePath = TeacherRequest::find($rollNo)->imagePath;
        
        $image = Image::make($imagePath);

        return $image->response();
    }

    /**
     * Get information of a student
     *
     * @param $rollNo
     * @return mixed
     */
    public function getStudentInfo ($rollNo)
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        // Get the student
        $student = Student::find($rollNo);
        $student->currentStudentState;

        return $student;
    }

    /**
     * Approve a student registration request
     *
     * @param Request $request
     * @return mixed
     */
    public function approveRequest (Request $request)
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }
        
        $rollNo = $request['rollNo'];

        // Update the status of the student request as approved
        TeacherRequest::find($rollNo)->update(['status' => 'approved']);

        return redirect()->back();
    }

    /**
     * Hold a student registration request
     *
     * @param Request $request
     * @return mixed
     */
    public function holdRequest (Request $request)
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        $rollNo = $request['rollNo'];
        $remarks = $request['remarks'];

        // Update the status of the student request as
        // pending and add the appropriate remarks
        TeacherRequest::find($rollNo)->update([
            'status' => 'pending',
            'remarks' => $remarks,
        ]);

        return redirect()->back();
    }

    /**
     * Register a student for new semester
     *
     * @param Request $request
     * @return mixed
     */
    public function registerStudent (Request $request)
    {
        if(!$this->isRegistrationActive('staff'))
        {
            return view($this->inactiveView);
        }

        $rollNo = $request['rollNo'];

        // Now register the student
        $verificationCode = $this->generateVerificationCode($rollNo);
        CurrentStudentState::find($rollNo)->update(['approved' => true, 'verificationCode' => $verificationCode]);
        Student::find($rollNo)->update(['semNo' =>  CurrentStudentState::find($rollNo)->semNo]);

        return redirect()->back();
    }

    /**
     * This function generates a unique verification code
     *
     * @param $rollNo
     * @return string
     */
    protected function generateVerificationCode ($rollNo)
    {
        $timeStamp = time();
        $hashString = $rollNo . $timeStamp;
        $verificationCode = bcrypt($hashString);

        return substr($verificationCode, 7, 5);
    }
}
