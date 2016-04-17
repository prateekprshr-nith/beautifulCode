<?php

namespace App\Http\Middleware;

use Closure;
use App\CurrentStudentState;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfInvalidStep, this class handles
 * the redirection logic for student users if
 * they try to visit next step url without
 * completing the valid previous  step
 *
 * @package App\Http\Middleware
 */
class RedirectIfInvalidStep
{
    /**
     * Handle an incoming request. Current state of the student in the registration process
     * is called step. There are a total of 3 steps in the semester registration
     * process and the step numbering used is as follows:
     *
     *  ______________________________
     * | #Step | Represented step     |
     *  ------------------------------
     * |   1   | initial details      |
     * |   2   | feeAndHostel details |
     * |   3   | course details       |
     *  ------------------------------
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  integer $currentStep
     * @return mixed
     */
    public function handle($request, Closure $next, $currentStep)
    {
        $currentStudentState = CurrentStudentState::find(Auth::guard('student')->user()->rollNo);

        // If student has not completed the first step
        // then redirect him to initial details page
        // other wise redirect him to the correct
        // page accourding to his current state
        if($currentStudentState == null)
        {
            // This check avoids redirection loop
            // in case the student is accessing
            // the initial details page
            if($currentStep != 1)
            {
                return redirect('/students/semesterRegistration/initialDetails');
            }

            return $next($request);
        }
        else
        {
            $step = $currentStudentState->step;

            // Redirect if student tries to visit a step
            // without completing the previous one and
            // let the request pass to the inner
            // layers if his request if valid
            if($currentStep != $step + 1)
            {
                if($step == 1)
                {
                    return redirect('/students/semesterRegistration/feeAndHostelDetails');
                }
                elseif($step == 2)
                {
                    return redirect('/students/semesterRegistration/courseDetails');
                }
                else    // if ($step == 3)
                {
                    return redirect('/students/semesterRegistration/status');
                }
            }

            return $next($request);
        }
    }
}
