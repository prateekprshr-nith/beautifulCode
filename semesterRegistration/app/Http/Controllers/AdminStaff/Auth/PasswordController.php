<?php

namespace App\Http\Controllers\AdminStaff\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController, this class handles
 * the resetting of adminStaff passwords
 *
 * @package App\Http\Controllers\AdminStaff\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    // Authentication guard to be used
    protected $guard = 'adminStaff';

    // Link request view to be used
    protected $linkRequestView = 'adminStaff.auth.passwords.email';

    // Reset view to be used
    protected $resetView = 'adminStaff.auth.passwords.reset';

    // Redirect path after reset
    protected $redirectPath = '/adminStaffs/home';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:adminStaff');
    }
}
