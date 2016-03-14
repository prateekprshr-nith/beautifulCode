<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Teacher;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController, this class handles
 * the login and registration of a teacher
 *
 * @package App\Http\Controllers\Teacher\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // Authentication guard to be used
    protected $guard = 'teacher';

    // Redirect to this url after login
    protected $redirectTo = '/teachers/home';

    // Redirect to this url after registration as teacher account
    // will be created by admin. So we want him to stay on the
    // home page from where he registered the teacher
    protected $redirectAfterRegis = '/admins/manage/teachers';

    // Registration view
    protected $registerView = 'teacher.auth.register';

    // Login view
    protected $loginView = 'teacher.auth.login';

    // User name field for login
    protected $username = 'facultyId';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:teacher', ['except' => 'logout']);
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
            'facultyId' => 'required|unique:teachers',
            'dCode' => 'required|regex:/[A-Z]{3,5}/',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:teachers',
            'office' => 'required',
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Create a new Teacher instance after a valid registration.
     *
     * @param  array  $data
     * @return Teacher
     */
    protected function create(array $data)
    {
        return Teacher::create([
            'facultyId' => $data['facultyId'],
            'dCode' => $data['dCode'],
            'name' => $data['name'],
            'email' => $data['email'],
            'office' => $data['office'],
            'password' => bcrypt($data['password']),
            'firstLogin' => true,
        ]);
    }

    /**
     * Handle a registration request for the application.
     * This method overrides the original register
     * method in RegisterUsers trait, because
     * we don't want the teacher to get
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
