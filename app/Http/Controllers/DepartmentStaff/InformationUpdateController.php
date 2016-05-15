<?php

namespace App\Http\Controllers\DepartmentStaff;

use Validator;
use App\Department;
use App\DepartmentStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\DepartmentStaff
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'departmentStaff.update.update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:departmentStaff');
        $this->middleware('firstLogin:departmentStaff');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param DepartmentStaff $departmentStaff
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, DepartmentStaff $departmentStaff)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:255|unique:departmentStaffs,email,'.$departmentStaff->id.',id',
        ]);
    }

    /**
     * Show information update form. Please note
     * that a departmentStaff can only update
     * his name, email and password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        // Get the logged in departmentStaff
        $departmentStaff = DepartmentStaff::find(Auth::guard('departmentStaff')->user()->id);

        // Get the list of departments present in databse
        $departments = Department::all();
       
        return view($this->updateInfoView, ['departmentStaff' => $departmentStaff, 'departments' => $departments]);
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
        $departmentStaff = DepartmentStaff::find(Auth::guard('departmentStaff')->user()->id);
        $newName = $request['name'];
        $newDcode = $request['dCode'];
        $newEmail = $request['email'];

        // Validate the new information
        $validator = $this->validator($request->all(), $departmentStaff);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save updated information
            $departmentStaff->name = $newName;
            $departmentStaff->dCode = $newDcode;
            $departmentStaff->email = $newEmail;
            $departmentStaff->save();

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
        $departmentStaff = DepartmentStaff::find(Auth::guard('departmentStaff')->user()->id);
        $newPassword = $request['password'];

        // Validate the password
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        // Save updated password
        $departmentStaff->password = bcrypt($newPassword);
        $departmentStaff->save();

        return redirect()->back()
            ->with('status', 'Success');
    }
}