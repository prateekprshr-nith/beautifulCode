<?php

namespace App\Http\Controllers\LibraryStaff\Auth;

use App\LibraryStaff;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController, this class handles
 * the login and registration of a libraryStaff
 *
 * @package App\Http\Controllers\LibraryStaff\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // Authentication guard to be used
    protected $guard = 'libraryStaff';

    // Redirect to this url after login/registration
    protected $redirectTo = '/libraryStaffs/home';

    // Registration view
    protected $registerView = 'libraryStaff.auth.register';

    // Login view
    protected $loginView = 'libraryStaff.auth.login';

    // User name field for login
    protected $username = 'id';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:libraryStaff', ['except' => 'logout']);
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
            'id' => 'required|unique:libraryStaffs',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:libraryStaffs',
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Create a new LibraryStaff instance after a valid registration.
     *
     * @param  array  $data
     * @return LibraryStaff
     */
    protected function create(array $data)
    {
        return LibraryStaff::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
