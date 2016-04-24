<?php

namespace App\Http\Controllers\DepartmentStaff\Auth;

use Validator;
use App\DepartmentStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class FirstLoginController, this class handles
 * the updation of passoword on first login.
 *
 * @package App\Http\Controllers\DepartmentStaff\Auth
 */
class FirstLoginController extends Controller
{
    // Password updation view
    protected $passwordUpdateView = 'departmentStaff.auth.passwords.updatePassword';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:departmentStaff');
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
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Show password update form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPasswordUpdateForm ()
    {
        return view($this->passwordUpdateView);
    }

    /**
     * Update the password
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function updatePassword (Request $request)
    {
        // Validate the password length
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        // Get the currently logged departmentStaff
        $departmentStaff = DepartmentStaff::find(Auth::guard('departmentStaff')->user()->id);

        $newPassword = $request['password'];
        $departmentStaff->password = bcrypt($newPassword);
        $departmentStaff->firstLogin = false;
        $departmentStaff->save();

        return redirect('/departmentStaffs/home');
    }
}
