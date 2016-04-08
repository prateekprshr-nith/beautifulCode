<?php

namespace App\Http\Controllers\ChiefWardenStaff\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController, this class handles
 * the resetting of chiefWardenStaff passwords
 *
 * @package App\Http\Controllers\ChiefWardenStaff\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    // Authentication guard to be used
    protected $guard = 'chiefWardenStaff';

    // Password reset broker to be used
    protected $broker = 'chiefWardenStaffs';

    // Link request view to be used
    protected $linkRequestView = 'chiefWardenStaff.auth.passwords.email';

    // Reset view to be used
    protected $resetView = 'chiefWardenStaff.auth.passwords.reset';

    // Redirect path after reset
    protected $redirectPath = '/chiefWardenStaffs/home';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:chiefWardenStaff');
    }
}
