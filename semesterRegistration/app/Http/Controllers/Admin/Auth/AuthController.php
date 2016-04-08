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
}
