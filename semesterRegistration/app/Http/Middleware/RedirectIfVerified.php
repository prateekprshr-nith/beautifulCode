<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfVerified, this class handles
 * the redirection of an user if his
 * account is already verified.
 *
 * @package App\Http\Middleware
 */
class RedirectIfVerified
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
            if(Auth::guard($guard)->user()->verified)
            {
                return redirect($guard . 's/home');
            }
        }

        return $next($request);
    }
}
