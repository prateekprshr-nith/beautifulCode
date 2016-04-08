<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check())
        {
            // Check for the guard and redirect accordingly
            if($guard == 'student')
            {
                return redirect('/students/home');
            }
            else if($guard == 'teacher')
            {
                return redirect('/teachers/home');
            }
            else if($guard == 'libraryStaff')
            {
                return redirect('/libraryStaffs/home');
            }
            else if($guard == 'hostelStaff')
            {
                return redirect('/hostelStaffs/home');
            }
            else if($guard == 'departmentStaff')
            {
                return redirect('/departmentStaffs/home');
            }
            else if($guard == 'chiefWardenStaff')
            {
                return redirect('/chiefWardenStaffs/home');
            }
            else if($guard == 'adminStaff')
            {
                return redirect('/adminStaffs/home');
            }
            else if($guard == 'admin')
            {
                return redirect('/admins/home');
            }
        }

        return $next($request);
    }
}
