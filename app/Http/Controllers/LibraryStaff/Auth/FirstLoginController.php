<?php

namespace App\Http\Controllers\LibraryStaff\Auth;

use Validator;
use App\LibraryStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class FirstLoginController, this class handles
 * the updation of passoword on first login.
 *
 * @package App\Http\Controllers\LibraryStaff\Auth
 */
class FirstLoginController extends Controller
{
    // Password updation view
    protected $passwordUpdateView = 'libraryStaff.auth.passwords.updatePassword';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:libraryStaff');
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

        // Get the currently logged libraryStaff
        $libraryStaff = LibraryStaff::find(Auth::guard('libraryStaff')->user()->id);

        $newPassword = $request['password'];
        $libraryStaff->password = bcrypt($newPassword);
        $libraryStaff->firstLogin = false;
        $libraryStaff->save();

        return redirect('/libraryStaffs/home');
    }
}
