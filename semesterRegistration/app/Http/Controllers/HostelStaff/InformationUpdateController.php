<?php

namespace App\Http\Controllers\HostelStaff;

use Validator;
use App\Hostel;
use App\HostelStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\HostelStaff
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'hostelStaff.update.update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:hostelStaff');
        $this->middleware('firstLogin:hostelStaff');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param HostelStaff $hostelStaff
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, HostelStaff $hostelStaff)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:255|unique:hostelStaffs,email,'.$hostelStaff->id.',id',
        ]);
    }

    /**
     * Show information update form. Please note
     * that a hostelStaff can only update
     * his name, email and password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        // Get the logged in hostelStaff
        $hostelStaff = HostelStaff::find(Auth::guard('hostelStaff')->user()->id);

        // Get the list of hostels present in databse
        $hostels = Hostel::all();
       
        return view($this->updateInfoView, ['hostelStaff' => $hostelStaff, 'hostels' => $hostels]);
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
        $hostelStaff = HostelStaff::find(Auth::guard('hostelStaff')->user()->id);
        $newName = $request['name'];
        $newHostelId = $request['hostelId'];
        $newEmail = $request['email'];

        // Validate the new information
        $validator = $this->validator($request->all(), $hostelStaff);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save updated information
            $hostelStaff->name = $newName;
            $hostelStaff->hostelId = $newHostelId;
            $hostelStaff->email = $newEmail;
            $hostelStaff->save();

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
        $hostelStaff = HostelStaff::find(Auth::guard('hostelStaff')->user()->id);
        $newPassword = $request['password'];

        // Validate the password
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        // Save updated password
        $hostelStaff->password = bcrypt($newPassword);
        $hostelStaff->save();

        return redirect()->back()
            ->with('status', 'Success');
    }
}