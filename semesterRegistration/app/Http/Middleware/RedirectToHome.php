<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectToHome, this class handles
 * the redirection of authenticated users
 * in case they try to visit the landing
 * page of the application and the auth
 * routes of other users.
 *
 * @package App\Http\Middleware
 */
class RedirectToHome
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $guardArr = [
            'student', 'teacher', 'libraryStaff',
            'hostelStaff', 'adminStaff', 'admin',
            'chiefWardenStaff',
        ];

        // Check if any of the above
        // user is logged in and
        // redirect accordingly
        foreach($guardArr as $guard)
        {
            if (Auth::guard($guard)->check())
            {
                $redirectTo = '/' . $guard .'s/home';
                return redirect($redirectTo);
            }
        }

        return $next($request);
    }
}
