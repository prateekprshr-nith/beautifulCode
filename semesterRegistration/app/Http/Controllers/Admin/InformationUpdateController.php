<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\Admin
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'admin.update.update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:admin');
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
            'password' => 'required|min:8',
        ]);
    }

    /**
     * Show information update form. Please note that
     * an admin can only update his password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        return view($this->updateInfoView);
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
        $admin = Admin::find(Auth::guard('admin')->user()->adminId);
        $newPassword = $request['password'];

        // Validate the new password length
        $validator = $this->validator($request->all());

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save new password
            $admin->password = bcrypt($newPassword);
            $admin->save();

            return redirect()->back()
                ->with('status', 'Success');
        }
    }
}
