<?php

namespace App\Http\Controllers\DepartmentStaff\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController, this class handles
 * the resetting of departmentStaff passwords
 *
 * @package App\Http\Controllers\DepartmentStaff\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    // Authentication guard to be used
    protected $guard = 'departmentStaff';

    // Password reset broker to be used
    protected $broker = 'departmentStaffs';

    // Link request view to be used
    protected $linkRequestView = 'departmentStaff.auth.passwords.email';

    // Reset view to be used
    protected $resetView = 'departmentStaff.auth.passwords.reset';

    // Redirect path after reset
    protected $redirectPath = '/departmentStaffs/home';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:departmentStaff');
    }
}
