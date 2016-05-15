<?php

namespace App\Http\Controllers\HostelStaff\Auth;

use App\HostelStaff;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController, this class handles
 * the login and registration of a hostelStaff
 *
 * @package App\Http\Controllers\HostelStaff\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // Authentication guard to be used
    protected $guard = 'hostelStaff';

    // Redirect to this url after login
    protected $redirectTo = '/hostelStaffs/home';

    // Redirect to this url after registration as teacher account
    // will be created by admin. So we want him to stay on the
    // same page from where he registered the hostelStaff
    protected $redirectAfterRegis = '/admins/manage/hostelStaffs';

    // Registration view
    protected $registerView = 'hostelStaff.auth.register';

    // Login view
    protected $loginView = 'hostelStaff.auth.login';

    // User name field for login
    protected $username = 'id';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:hostelStaff', ['except' => 'logout']);
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
            'id' => 'required|unique:hostelStaffs',
            'hostelId' => 'required',
            'name' => 'required|max:255|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:255|unique:hostelStaffs',
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Create a new HostelStaff instance after a valid registration.
     *
     * @param  array  $data
     * @return HostelStaff
     */
    protected function create(array $data)
    {
        return HostelStaff::create([
            'id' => $data['id'],
            'hostelId' => $data['hostelId'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'firstLogin' => true,
        ]);
    }

    /**
     * Handle a registration request for the application.
     * This method overrides the original register
     * method in RegisterUsers trait, because
     * we don't want the hostelStaff to get
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
