<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController, this class handles
 * the login and registration of a admin
 *
 * @package App\Http\Controllers\Admin\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // Authentication guard to be used
    protected $guard = 'admin';

    // Redirect to this url after login/registration
    protected $redirectTo = '/admins/home';

    // Registration view, not active for admin
    // protected $registerView = 'admin.auth.register';

    // Login view
    protected $loginView = 'admin.auth.login';

    // User name field for login
    protected $username = 'adminId';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    /*
    **
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     *
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'rollNo' => 'required|regex:/[0-9]{2}M?[0-9]{3}/|unique:admins',
            'dCode' => 'required|regex:/[A-Z]{3,5}/',
            'semNo' => 'required|regex:/[0-9]{1,2}/',
            'registrationNo' => 'required|regex:/[0-9]+\/[0-9]+/|unique:admins',
            'sectionId' => 'required|regex:/[A-Z][123]/',
            'name' => 'required|max:255',
            'fatherName' => 'required|max:255',
            'motherName' =>'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'phoneNo' => 'required|regex:/(\+91)?[0-9]{10}/|unique:admins',
            'currentAddress' => 'required',
            'permanentAddress' => 'required',
            'password' => 'required|min:8',
            'dob' => 'required|date',
        ]);
    }

    **
     * Create a new Admin instance after a valid registration.
     *
     * @param  array  $data
     * @return Admin
     *
    protected function create(array $data)
    {
        return Admin::create([
            'rollNo' => $data['rollNo'],
            'dCode' => $data['dCode'],
            'semNo' => $data['semNo'],
            'registrationNo' => $data['registrationNo'],
            'sectionId' => $data['sectionId'],
            'name' => $data['name'],
            'fatherName' => $data['fatherName'],
            'motherName' => $data['motherName'],
            'email' => $data['email'],
            'phoneNo' => $data['phoneNo'],
            'currentAddress' => $data['currentAddress'],
            'permanentAddress' => $data['permanentAddress'],
            'password' => bcrypt($data['password']),
            'dob' => $data['dob'],
        ]);
    }
    */
}
