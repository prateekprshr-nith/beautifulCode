<?php

namespace App\Http\Controllers\HostelStaff\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController, this class handles
 * the resetting of hostelStaff passwords
 *
 * @package App\Http\Controllers\HostelStaff\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    // Authentication guard to be used
    protected $guard = 'hostelStaff';

    // Link request view to be used
    protected $linkRequestView = 'hostelStaff.auth.passwords.email';

    // Reset view to be used
    protected $resetView = 'hostelStaff.auth.passwords.reset';

    // Redirect path after reset
    protected $redirectPath = '/hostelStaffs/home';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:hostelStaff');
    }
}
