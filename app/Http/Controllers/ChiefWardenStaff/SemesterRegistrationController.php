<?php

namespace App\Http\Controllers\ChiefWardenStaff;

use App\Student;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\ChiefWardenStaffRequest;
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
    protected $newRequestsView = 'chiefWardenStaff.semesterRegistration.newRequests';
    protected $pendingRequestsView = 'chiefWardenStaff.semesterRegistration.pendingRequests';
    protected $approvedRequestsView = 'chiefWardenStaff.semesterRegistration.approvedRequests';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:chiefWardenStaff');
        $this->middleware('firstLogin:chiefWardenStaff');
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
        $countArr['newCount'] = count(ChiefWardenStaffRequest::where(['status' => 'new'])->get());
        $countArr['pendingCount'] = count(ChiefWardenStaffRequest::where(['status' => 'pending'])->get());
        $countArr['approvedCount'] = count(ChiefWardenStaffRequest::where(['status' => 'approved'])->get());

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
        $requests = ChiefWardenStaffRequest::where(['status' => 'new'])->simplePaginate('8');

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
        $requests = ChiefWardenStaffRequest::where(['status' => 'pending'])->simplePaginate('8');

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
        $requests = ChiefWardenStaffRequest::where(['status' => 'approved'])->simplePaginate('8');

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
        ChiefWardenStaffRequest::find($rollNo)->update([
            'status' => 'approved',
            'remarks' => null,
        ]);

        return redirect('/chiefWardenStaffs/semesterRegistration/studentRequests/new');
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
        ChiefWardenStaffRequest::find($rollNo)->update([
            'status' => 'pending',
            'remarks' => $remarks,
        ]);

        return redirect('/chiefWardenStaffs/semesterRegistration/studentRequests/new');
    }
}