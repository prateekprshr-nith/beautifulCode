<?php

namespace App\Http\Controllers\AdminStaff;

use Validator;
use App\AdminStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\AdminStaff
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'adminStaff.update.update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:adminStaff');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param AdminStaff $adminStaff
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, AdminStaff $adminStaff)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:adminStaffs,email,'.$adminStaff->id.',id',
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Show information update form. Please note
     * that a adminStaff can only update
     * his name, email and password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        // Get the logged in adminStaff
        $adminStaff = AdminStaff::find(Auth::guard('adminStaff')->user()->id);
        return view($this->updateInfoView, ['adminStaff' => $adminStaff]);
    }

    /**
     * Update user information
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    public function updateInfo (Request $request)
    {
        // Get the logged in user
        $adminStaff = AdminStaff::find(Auth::guard('adminStaff')->user()->id);
        $newName = $request['name'];
        $newEmail = $request['email'];
        $newPassword = $request['password'];

        // Validate the new information
        $validator = $this->validator($request->all(), $adminStaff);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save updated information
            $adminStaff->name = $newName;
            $adminStaff->email = $newEmail;
            $adminStaff->password = bcrypt($newPassword);
            $adminStaff->save();

            return redirect()->back()
                ->with('status', 'Success');
        }
    }
}
