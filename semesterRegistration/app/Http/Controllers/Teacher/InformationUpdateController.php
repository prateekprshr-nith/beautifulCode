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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:teachers',
            'office' => 'required',
            'password' => 'required|min:8',
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
        $newPassword = $request['password'];

        // Validate the new information
        $validator = $this->validator($request->all());

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
            $teacher->password = bcrypt($newPassword);
            $teacher->save();

            return redirect()->back()
                ->with('status', 'Success');
        }
    }
}
