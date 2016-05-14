<?php

namespace App\Http\Controllers\HostelStaff;

use App\Student;
use App\Http\Requests;
use App\HostelStaffRequest;
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
    protected $newRequestsView = 'hostelStaff.semesterRegistration.newRequests';
    protected $pendingRequestsView = 'hostelStaff.semesterRegistration.pendingRequests';
    protected $approvedRequestsView = 'hostelStaff.semesterRegistration.approvedRequests';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:hostelStaff');
        $this->middleware('firstLogin:hostelStaff');
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
        $hostelId = Auth::guard('hostelStaff')->user()->hostelId;

        $countArr['newCount'] = count(HostelStaffRequest::where([
            'status' => 'new',
            'hostelId' => $hostelId,
        ])->get());

        $countArr['pendingCount'] = count(HostelStaffRequest::where([
            'status' => 'pending',
            'hostelId' => $hostelId,
        ])->get());

        $countArr['approvedCount'] = count(HostelStaffRequest::where([
            'status' => 'approved',
            'hostelId' => $hostelId,
        ])->get());

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
        $requests = HostelStaffRequest::where([
            'status' => 'new',
            'hostelId' => Auth::guard('hostelStaff')->user()->hostelId,
        ])->simplePaginate('8');

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
        $requests = HostelStaffRequest::where([
            'status' => 'pending',
            'hostelId' => Auth::guard('hostelStaff')->user()->hostelId,
        ])->simplePaginate('8');

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
        $requests = HostelStaffRequest::where([
            'status' => 'approved',
            'hostelId' => Auth::guard('hostelStaff')->user()->hostelId,
        ])->simplePaginate('8');

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
        HostelStaffRequest::find($rollNo)->update([
            'status' => 'approved',
            'remarks' => null,
        ]);

        return redirect('/hostelStaffs/semesterRegistration/studentRequests/new');
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
        HostelStaffRequest::find($rollNo)->update([
            'status' => 'pending',
            'remarks' => $remarks,
        ]);

        return redirect('/hostelStaffs/semesterRegistration/studentRequests/new');
    }
}