<?php

namespace App\Http\Controllers\AdminStaff;

use App\Student;
use App\Http\Requests;
use App\AdminStaffRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class SemesterRegistrationController, this class contains
 * all the logic for student semester registration process
 * 
 * @package App\Http\Controllers
 */
class SemesterRegistrationController extends Controller
{
    // Views dealing with semester registration
    protected $newRequestsView = 'adminStaff.semesterRegistration.newRequests';
    protected $pendingRequestsView = 'adminStaff.semesterRegistration.pendingRequests';
    protected $approvedRequestsView = 'adminStaff.semesterRegistration.approvedRequests';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:adminStaff');
        $this->middleware('firstLogin:adminStaff');
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
        $countArr['newCount'] = count(AdminStaffRequest::where(['status' => 'new'])->get());
        $countArr['pendingCount'] = count(AdminStaffRequest::where(['status' => 'pending'])->get());
        $countArr['approvedCount'] = count(AdminStaffRequest::where(['status' => 'approved'])->get());

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
        $requests = AdminStaffRequest::where(['status' => 'new'])->get();

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
        $requests = AdminStaffRequest::where(['status' => 'pending'])->get();

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
        $requests = AdminStaffRequest::where(['status' => 'approved'])->get();

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
        AdminStaffRequest::find($rollNo)->update([
            'status' => 'approved',
            'remarks' => null,
        ]);

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
        AdminStaffRequest::find($rollNo)->update([
            'status' => 'pending',
            'remarks' => $remarks,
        ]);

        return redirect()->back();
    }
}