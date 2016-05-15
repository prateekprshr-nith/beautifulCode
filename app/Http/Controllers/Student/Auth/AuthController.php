<?php

namespace App\Http\Controllers\Student\Auth;

use Validator;
use App\Student;
use App\Section;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController, this class handles
 * the login and registration of a student.
 *
 * @package App\Http\Controllers\Student\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // Authentication guard to be used
    protected $guard = 'student';

    // Redirect to this url after login/registration
    protected $redirectTo = '/students/home';

    // Registration view
    protected $registerView = 'student.auth.register';

    // Login view
    protected $loginView = 'student.auth.login';

    // User name field for login
    protected $username = 'rollNo';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:student', ['except' => 'logout']);
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
            'rollNo' => 'required|regex:/[0-9]{2}M?[0-9]{3}/|unique:students',
            'dCode' => 'required|regex:/[A-Z]{3,5}/',
            'semNo' => 'required|regex:/[0-9]{1,2}/',
            'registrationNo' => 'required|regex:/[0-9]+\/[0-9]+/|unique:students',
            'sectionId' => 'required|regex:/[A-Z][123]/',
            'name' => 'required|max:255|regex:/^[a-zA-Z ]*$/',
            'fatherName' => 'required|max:255|regex:/^[a-zA-Z ]*$/',
            'motherName' =>'required|max:255|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:255|unique:students',
            'phoneNo' => 'required|regex:/(\+91)?[0-9]{10}/|unique:students',
            'currentAddress' => 'required',
            'permanentAddress' => 'required',
            'password' => 'required|min:8',
            'dob' => 'required|date',
        ]);
    }

    /**
     * Create a new Student instance after a valid registration.
     *
     * @param  array  $data
     * @return Student
     */
    protected function create(array $data)
    {
        // Create a Student instance
        $student = Student::create([
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
            'verified' => false,
        ]);

        return $student;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // Get the list of departments
        $departmentArr = Department::all();

        // Get the list of sections
        $sectionArr = Section::all();

        return view($this->registerView)->with(['departments' => $departmentArr, 'sections' => $sectionArr]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();
        Session::flush();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
