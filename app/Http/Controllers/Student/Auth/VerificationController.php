<?php

namespace App\Http\Controllers\Student\Auth;

use Mail;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class VerificationController, this class handles
 * the tasks of verification of student account.
 *
 * @package App\Http\Controllers\Student\Auth
 */
class VerificationController extends Controller
{
    // Account verification view
    protected $verificationView = 'student.auth.verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Show verification form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVerificationForm ()
    {
        return view($this->verificationView);
    }

    /**
     * Verify user account
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function verifyUserAccount (Request $request)
    {
        // Get currently logged in student
        $student = Student::find(Auth::guard('student')->user()->rollNo);

        $verificationCode = $request['verificationCode'];

        if(Auth::guard('student')->user()->verificationCode == $verificationCode)
        {
            $student->verified = true;
            $student->save();

            return redirect('/students/home');
        }
        else
        {
            return redirect()->back()
                ->withErrors('This code in invalid! Please use a correct code');
        }
    }

    /**
     * This function sends a verification
     * mail with code to the students.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendVerifiactionMail ()
    {
        // Get currently logged in student
        $student = Student::find(Auth::guard('student')->user()->rollNo);

        $verificationCode = $this->generateVerificationCode($student->rollNo);
        $student->verificationCode = $verificationCode;
        $student->save();

        Mail::queue('student.auth.emails.verification', ['student' => $student], function ($msg) use ($student) {
            $msg->from('noreply@semesterregistration.com', 'Support');
            $msg->to($student->email, $student->name)->subject('Your Verification code');
        });

        $statusMsg = 'Verification code successfully sent on ' . $student->email;

        return redirect()->back()->with('status', $statusMsg);
    }

    /**
     * This function generates a unique verification
     * code which has to be sent on students email.
     *
     * @param $rollNo
     * @return string
     */
    protected function generateVerificationCode ($rollNo)
    {
        $timeStamp = time();
        $hashString = $rollNo . $timeStamp;
        $verificationCode = md5($hashString);

        return $verificationCode;
    }
}
