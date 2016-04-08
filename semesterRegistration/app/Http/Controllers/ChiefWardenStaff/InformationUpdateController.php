<?php

namespace App\Http\Controllers\ChiefWardenStaff;

use Validator;
use App\ChiefWardenStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\ChiefWardenStaff
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'chiefWardenStaff.update.update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:chiefWardenStaff');
        $this->middleware('firstLogin:chiefWardenStaff');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param ChiefWardenStaff $chiefWardenStaff
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, ChiefWardenStaff $chiefWardenStaff)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:255|unique:chiefWardenStaffs,email,'.$chiefWardenStaff->id.',id',
        ]);
    }

    /**
     * Show information update form. Please note
     * that a chiefWardenStaff can only update
     * his name, email and password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        // Get the logged in chiefWardenStaff
        $chiefWardenStaff = ChiefWardenStaff::find(Auth::guard('chiefWardenStaff')->user()->id);
        return view($this->updateInfoView, ['chiefWardenStaff' => $chiefWardenStaff]);
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
        $chiefWardenStaff = ChiefWardenStaff::find(Auth::guard('chiefWardenStaff')->user()->id);
        $newName = $request['name'];
        $newEmail = $request['email'];

        // Validate the new information
        $validator = $this->validator($request->all(), $chiefWardenStaff);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save updated information
            $chiefWardenStaff->name = $newName;
            $chiefWardenStaff->email = $newEmail;
            $chiefWardenStaff->save();

            return redirect()->back()
                ->with('status', 'Success');
        }
    }

    /**
     * Update user password
     *
     * @param Request $request
     * @return mixed
     */
    public function updatePassword (Request $request)
    {
        // Get the logged in user
        $chiefWardenStaff = ChiefWardenStaff::find(Auth::guard('chiefWardenStaff')->user()->id);
        $newPassword = $request['password'];

        // Validate the password
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        // Save updated password
        $chiefWardenStaff->password = bcrypt($newPassword);
        $chiefWardenStaff->save();

        return redirect()->back()
            ->with('status', 'Success');
    }
}
