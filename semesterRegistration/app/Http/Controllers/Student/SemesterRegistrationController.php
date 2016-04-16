<?php

namespace App\Http\Controllers\Student;

use App\Grade;
use App\Student;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\CurrentStudentState;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/**
 * Class SemesterRegistrationController, this class contains
 * the logic for the semester registration of student
 *
 * @package App\Http\Controllers\Student
 */
class SemesterRegistrationController extends Controller
{
    // Views for registration steps
    protected $inactiveView = 'common.inactive';
    protected $initialDetailsView = 'student.semesterRegistration.initialDetails';
    protected $courseDetailsView = 'student.semesterRegistration.courseManagement';
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
     * Show the initial details view to the student
     *
     * @return mixed
     */
    public function showInitialDetailsView ()
    {
        if(!file_exists(storage_path() . '/app/activeForStudents'))
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
        if(!file_exists(storage_path() . '/app/activeForStudents'))
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
        $currentStudentState->save();
        
        // Now redirect accordingly
        if($currentStudentState->feeReceipt == false && $currentStudentState->hostler == false)
        {
            return redirect('/students/semesterRegistration/courseDetails');
        }
        else
        {
            return redirect('/students/semesterRegistration/feeAndHostelDetails');
        }
    }
}
