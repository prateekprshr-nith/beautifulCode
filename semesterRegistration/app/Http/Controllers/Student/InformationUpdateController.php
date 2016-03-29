<?php

namespace App\Http\Controllers\Student;

use Validator;
use App\Student;
use App\StudentImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

/**
 * Class InformationUpdateController, this class
 * handles information updation of the users.
 *
 * @package App\Http\Controllers\Student
 */
class InformationUpdateController extends Controller
{
    // Information update view
    protected $updateInfoView = 'student.update.update';

    // Image update view
    protected $updateImageView = 'student.update.updateImage';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth:student');
        $this->middleware('verify:student');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param Student $student
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, Student $student)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'fatherName' => 'required|max:255',
            'motherName' =>'required|max:255',
            'email' => 'required|email|max:255|unique:students,email,'.$student->rollNo.',rollNo',
            'phoneNo' => 'required|regex:/(\+91)?[0-9]{10}/|unique:students',
            'currentAddress' => 'required',
            'permanentAddress' => 'required',
            'dob' => 'required|date',
        ]);
    }

    /**
     * Show information update form. Please note that
     * a student can only update his name,
     * email, office and password
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateInfoForm ()
    {
        // Get the logged in student
        $student = Student::find(Auth::guard('student')->user()->rollNo);
        return view($this->updateInfoView, ['student' => $student]);
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
        $student = Student::find(Auth::guard('student')->user()->rollNo);
        $newName = $request['name'];
        $newFatherName = $request['fatherName'];
        $newMotherName = $request['motherName'];
        $newEmail = $request['email'];
        $newDob = $request['dob'];

        // Validate the new information
        $validator = $this->validator($request->all(), $student);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
            // Save updated information
            $student->name = $newName;
            $student->email = $newEmail;
            $student->fatherName = $newFatherName;
            $student->motherName = $newMotherName;
            $student->dob = $newDob;
            $student->save();

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
        $student = Student::find(Auth::guard('student')->user()->rollNo);
        $newPassword = $request['password'];

        // Validate the password
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        // Save updated password
        $student->password = bcrypt($newPassword);
        $student->save();

        return redirect()->back()
            ->with('status', 'Success');
    }

    /**
     * Show the image upload form
     *
     * @return mixed
     */
    public function showImageUploadForm ()
    {
        return view($this->updateImageView);
    }

    /**
     * Upload / update student image
     *
     * @param Request $request
     * @return mixed
     */
    public function updateImage (Request $request)
    {
        if($request->hasFile('image'))
        {
            $this->validate($request, [
                'image' => 'image|required|max:1024',
            ]);

            if ($request->file('image')->isValid())
            {
                $image = $request->file('image');
                $rollNo = Auth::guard('student')->user()->rollNo;

                // Set the image parameters
                $imageQuality = 70;
                $imagePath = env('IMAGE_DIR') . '/avatars/' . $rollNo . '.jpg';

                // Save the image
                Image::make($image->getRealPath())
                    ->save($imagePath, $imageQuality);

                // Save the image path in database
                // in case of first time upload.
                $studentImage = new StudentImage;
                
                if($studentImage::find($rollNo) == null)
                {
                    $studentImage->rollNo = $rollNo;
                    $studentImage->imagePath = $imagePath;
                    $studentImage->save();
                }

                return redirect('/students/home');
            }
            else
            {
                return redirect()->back()
                    ->withErrors('Upload unsuccessful!!!');
            }
        }
        else
        {
            return redirect()->back()
                ->withErrors('Please choose an image file!!!');
        }
    }

    /**
     * This function sets a session variable
     * in case a student does not want to
     * upload his profile picture.
     *
     * @param Request $request
     * @return mixed
     */
    public function setImageUploadSkipSession (Request $request)
    {
        // Set the session variable to skip the
        // image upload page on furthur
        // student requests.
        if(!$request->session()->has('imageUploadSkipped'))
        {
            $request->session()->put('imageUploadSkipped', true);
        }

        return redirect('/students/home');
    } 
}
