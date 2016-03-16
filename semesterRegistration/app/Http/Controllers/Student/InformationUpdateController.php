<?php

namespace App\Http\Controllers\Student;

use Validator;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\Student
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'student.update.update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param Student $student
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, Student $student)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'fatherName' => 'required|max:255',
            'motherName' =>'required|max:255',
            'email' => 'required|email|max:255|unique:students,email,'.$student->rollNo.',rollNo',
            'phoneNo' => 'required|regex:/(\+91)?[0-9]{10}/|unique:students',
            'currentAddress' => 'required',
            'permanentAddress' => 'required',
            'password' => 'required|min:8',
            'dob' => 'required|date',
        ]);
    }

    /**
     * Show information update form. Please note that
     * a student can only update his name,
     * email, office and password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        // Get the logged in student
        $student = Student::find(Auth::guard('student')->user()->rollNo);
        return view($this->updateInfoView, ['student' => $student]);
    }

    /**
     * Update user information
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function updateInfo (Request $request)
    {
        // Get the logged in user
        $student = Student::find(Auth::guard('student')->user()->rollNo);
        $newName = $request['name'];
        $newFatherName = $request['fatherName'];
        $newMotherName = $request['motherName'];
        $newEmail = $request['email'];
        $newDob = $request['dob'];
        $newPassword = $request['password'];

        // Validate the new information
        $validator = $this->validator($request->all(), $student);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save updated information
            $student->name = $newName;
            $student->email = $newEmail;
            $student->fatherName = $newFatherName;
            $student->motherName = $newMotherName;
            $student->dob = $newDob;
            $student->password = bcrypt($newPassword);
            $student->save();

            return redirect()->back()
                ->with('status', 'Success');
        }
    }
}
