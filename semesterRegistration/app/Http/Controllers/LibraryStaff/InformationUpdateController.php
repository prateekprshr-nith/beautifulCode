<?php

namespace App\Http\Controllers\LibraryStaff;

use Validator;
use App\Hostel;
use App\LibraryStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\LibraryStaff
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'libraryStaff.update.update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:libraryStaff');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param LibraryStaff $libraryStaff
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, LibraryStaff $libraryStaff)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:libraryStaffs,email,'.$libraryStaff->id.',id',
        ]);
    }

    /**
     * Show information update form. Please note
     * that a libraryStaff can only update
     * his name, email and password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        // Get the logged in libraryStaff
        $libraryStaff = LibraryStaff::find(Auth::guard('libraryStaff')->user()->id);

        // Get the list of hostels present in databse
        $hostels = Hostel::all();

        return view($this->updateInfoView, ['libraryStaff' => $libraryStaff, 'hostels' => $hostels]);
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
        $libraryStaff = LibraryStaff::find(Auth::guard('libraryStaff')->user()->id);
        $newName = $request['name'];
        $newEmail = $request['email'];

        // Validate the new information
        $validator = $this->validator($request->all(), $libraryStaff);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save updated information
            $libraryStaff->name = $newName;
            $libraryStaff->email = $newEmail;
            $libraryStaff->save();

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
        $libraryStaff = LibraryStaff::find(Auth::guard('libraryStaff')->user()->id);
        $newPassword = $request['password'];

        // Validate the password
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        // Save updated password
        $libraryStaff->password = bcrypt($newPassword);
        $libraryStaff->save();

        return redirect()->back()
            ->with('status', 'Success');
    }
}