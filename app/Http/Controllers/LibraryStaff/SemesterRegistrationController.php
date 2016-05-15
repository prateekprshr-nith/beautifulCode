<?php

namespace App\Http\Controllers\LibraryStaff;

use App\Student;
use App\Http\Requests;
use App\LibraryStaffRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SemesterRegistrationController, this class contains
 * all the logic for student semester registration process
 * 
 * @package App\Http\Controllers
 */
class SemesterRegistrationController extends Controller
{
    // Views dealing with semester registration
    protected $newRequestsView = 'libraryStaff.semesterRegistration.newRequests';
    protected $pendingRequestsView = 'libraryStaff.semesterRegistration.pendingRequests';
    protected $approvedRequestsView = 'libraryStaff.semesterRegistration.approvedRequests';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:libraryStaff');
        $this->middleware('firstLogin:libraryStaff');
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
        $countArr['newCount'] = count(LibraryStaffRequest::where(['status' => 'new'])->get());
        $countArr['pendingCount'] = count(LibraryStaffRequest::where(['status' => 'pending'])->get());
        $countArr['approvedCount'] = count(LibraryStaffRequest::where(['status' => 'approved'])->get());

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
        $requests = LibraryStaffRequest::where(['status' => 'new'])->simplePaginate('8');

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
        $requests = LibraryStaffRequest::where(['status' => 'pending'])->simplePaginate('8');

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
        $requests = LibraryStaffRequest::where(['status' => 'approved'])->simplePaginate('8');

        $requestCount = $this->getRequestCounts();

        return view($this->approvedRequestsView, ['requests' => $requests, 'count' => 0,  'requestCount' => $requestCount]);
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
        $student->department->dName;
        $student->currentStudentState->semNo;

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
        LibraryStaffRequest::find($rollNo)->update([
            'status' => 'approved',
            'remarks' => null,
        ]);

        return redirect('/libraryStaffs/semesterRegistration/studentRequests/new');
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
        LibraryStaffRequest::find($rollNo)->update([
            'status' => 'pending',
            'remarks' => $remarks,
        ]);

        return redirect('/libraryStaffs/semesterRegistration/studentRequests/new');
    }
}