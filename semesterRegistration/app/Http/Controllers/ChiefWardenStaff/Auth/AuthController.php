<?php

namespace App\Http\Controllers\ChiefWardenStaff\Auth;

use App\ChiefWardenStaff;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController, this class handles
 * the login and registration of a chiefWardenStaff
 *
 * @package App\Http\Controllers\ChiefWardenStaff\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // Authentication guard to be used
    protected $guard = 'chiefWardenStaff';

    // Redirect to this url after login
    protected $redirectTo = '/chiefWardenStaffs/home';

    // Redirect to this url after registration as teacher account
    // will be created by admin. So we want him to stay on the
    // home page from where he registered the chiefWardenStaff
    protected $redirectAfterRegis = '/admins/manage/chiefWardenStaffs';

    // Registration view
    protected $registerView = 'chiefWardenStaff.auth.register';

    // Login view
    protected $loginView = 'chiefWardenStaff.auth.login';

    // User name field for login
    protected $username = 'id';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:chiefWardenStaff', ['except' => 'logout']);
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
            'id' => 'required|unique:chiefWardenStaffs',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:chiefWardenStaffs',
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Create a new ChiefWardenStaff instance after a valid registration.
     *
     * @param  array  $data
     * @return ChiefWardenStaff
     */
    protected function create(array $data)
    {
        return ChiefWardenStaff::create([
            'id' => $data['id'],
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
     * we don't want the chiefWardenStaff to get
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
