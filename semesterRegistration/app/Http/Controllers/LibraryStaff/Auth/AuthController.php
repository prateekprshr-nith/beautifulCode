<?php

namespace App\Http\Controllers\LibraryStaff\Auth;

use App\LibraryStaff;
use Validator;
use Illuminate\Http\Request;
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

    // Redirect to this url after login
    protected $redirectTo = '/libraryStaffs/home';

    // Redirect to this url after registration as teacher account
    // will be created by admin. So we want him to stay on the
    // home page from where he registered the libraryStaff
    protected $redirectAfterRegis = '/admins/manage/libraryStaffs';

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

    /**
     * Handle a registration request for the application.
     * This method overrides the original register
     * method in RegisterUsers trait, because
     * we don't want the libraryStaff to get
     * logged in automatically after
     * registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $this->create($request->all());

        return redirect($this->redirectAfterRegis);
    }
}
