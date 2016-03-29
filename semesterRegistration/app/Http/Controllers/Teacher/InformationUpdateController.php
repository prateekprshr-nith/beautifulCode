<?php

namespace App\Http\Controllers\Teacher;

use Validator;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\Teacher
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'teacher.update.update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:teacher');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param Teacher $teacher
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, Teacher $teacher)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:teachers,email,'.$teacher->facultyId.',facultyId',
            'office' => 'required',
        ]);
    }

    /**
     * Show information update form. Please note that
     * a teacher can only update his name,
     * email, office and password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        // Get the logged in teacher
        $teacher = Teacher::find(Auth::guard('teacher')->user()->facultyId);
        return view($this->updateInfoView, ['teacher' => $teacher]);
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
        $teacher = Teacher::find(Auth::guard('teacher')->user()->facultyId);
        $newName = $request['name'];
        $newEmail = $request['email'];
        $newOffice = $request['office'];

        // Validate the new information
        $validator = $this->validator($request->all(), $teacher);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save updated information
            $teacher->name = $newName;
            $teacher->email = $newEmail;
            $teacher->office = $newOffice;
            $teacher->save();

            return redirect()->back()
                ->with('status', 'Success');
        }
    }

    /**
     * Update user password
     *
     * @param Request $request
     * @return mixed
     */
    public function updatePassword (Request $request)
    {
        // Get the logged in user
        $teacher = Teacher::find(Auth::guard('teacher')->user()->facultyId);
        $newPassword = $request['password'];

        // Validate the password
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        // Save updated password
        $teacher->password = bcrypt($newPassword);
        $teacher->save();

        return redirect()->back()
            ->with('status', 'Success');
    }
}

