<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfNotFirstLogin, this class handles
 * the redirection of staff members and teachers
 * if this is not their first login.
 *
 * @package App\Http\Middleware
 */
class RedirectIfNotFirstLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard($guard)->check())            // Check if user is authenticated
        {
            if(!Auth::guard($guard)->user()->firstLogin)
            {
                return redirect($guard . 's/home');
            }
        }

        return $next($request);
    }
}
