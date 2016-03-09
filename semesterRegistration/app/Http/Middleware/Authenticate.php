<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class Authenticate, this class handles the
 * redirection for unauthenticated users.
 *
 * @package App\Http\Middleware
 */
class Authenticate
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
        // Check for the guard and redirect accordingly
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson())
            {
                return response('Unauthorized.', 401);
            }
            elseif($guard == 'student')
            {
                return redirect()->guest('/students/login');
            }
            elseif($guard == 'teacher')
            {
                return redirect()->guest('/teachers/login');
            }
            elseif($guard == 'hostelStaff')
            {
                return redirect()->guest('/hostelStaffs/login');
            }
            elseif($guard == 'libraryStaff')
            {
                return redirect()->guest('/libraryStaffs/login');
            }
            elseif($guard == 'adminStaff')
            {
                return redirect()->guest('/adminStaffs/login');
            }
            elseif($guard == 'admin')
            {
                return redirect()->guest('/admins/login');
            }
        }

        return $next($request);
    }
}
