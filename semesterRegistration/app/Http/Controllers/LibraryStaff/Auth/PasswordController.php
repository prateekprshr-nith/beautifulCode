<?php

namespace App\Http\Controllers\LibraryStaff\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Class PasswordController, this class handles
 * the resetting of libraryStaff passwords
 *
 * @package App\Http\Controllers\LibraryStaff\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    // Authentication guard to be used
    protected $guard = 'libraryStaff';

    // Link request view to be used
    protected $linkRequestView = 'libraryStaff.auth.passwords.email';

    // Reset view to be used
    protected $resetView = 'libraryStaff.auth.passwords.reset';

    // Redirect path after reset
    protected $redirectPath = '/libraryStaffs/home';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:libraryStaff');
    }
}
