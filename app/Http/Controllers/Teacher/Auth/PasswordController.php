<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController, this class handles
 * the resetting of teacher passwords
 *
 * @package App\Http\Controllers\Teacher\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    // Authentication guard to be used
    protected $guard = 'teacher';

    // Password reset broker to be used
    protected $broker = 'teachers';

    // Link request view to be used
    protected $linkRequestView = 'teacher.auth.passwords.email';

    // Reset view to be used
    protected $resetView = 'teacher.auth.passwords.reset';

    // Redirect path after reset
    protected $redirectPath = '/teachers/home';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:teacher');
    }
}
