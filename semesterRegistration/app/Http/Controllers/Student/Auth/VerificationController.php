<?php

namespace App\Http\Controllers\Student\Auth;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    protected function showVerificationForm ()
    {
        return view($this->verificationView);
    }

    /**
     * Verify user account
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    protected function verifyUserAccount (Request $request)
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
}
