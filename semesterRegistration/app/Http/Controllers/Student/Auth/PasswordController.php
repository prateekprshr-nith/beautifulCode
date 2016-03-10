<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController, this class handles
 * the resetting of student passwords
 *
 * @package App\Http\Controllers\Student\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    // Authentication guard to be used
    protected $guard = 'student';

    // Password reset broker to be used
    protected $broker = 'students';

    // Link request view to be used
    protected $linkRequestView = 'student.auth.passwords.email';

    // Reset view to be used
    protected $resetView = 'student.auth.passwords.reset';

    // Redirect path after reset
    protected $redirectPath = '/students/home';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:student');
    }
}
