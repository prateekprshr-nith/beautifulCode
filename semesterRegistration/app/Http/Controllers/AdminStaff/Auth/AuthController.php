<?php

namespace App\Http\Controllers\AdminStaff\Auth;

use App\AdminStaff;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController, this class handles
 * the login and registration of a adminStaff
 *
 * @package App\Http\Controllers\AdminStaff\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // Authentication guard to be used
    protected $guard = 'adminStaff';

    // Redirect to this url after login/registration
    protected $redirectTo = '/adminStaffs/home';

    // Registration view
    protected $registerView = 'adminStaff.auth.register';

    // Login view
    protected $loginView = 'adminStaff.auth.login';

    // User name field for login
    protected $username = 'id';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:adminStaff', ['except' => 'logout']);
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
            'id' => 'required|unique:adminStaffs',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:adminStaffs',
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Create a new AdminStaff instance after a valid registration.
     *
     * @param  array  $data
     * @return AdminStaff
     */
    protected function create(array $data)
    {
        return AdminStaff::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
