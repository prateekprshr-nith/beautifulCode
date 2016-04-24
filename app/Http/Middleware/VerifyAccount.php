<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class VerifyAccount, this class handles
 * the redirection of a user, in case his
 * account has not been verified.
 *
 * @package App\Http\Middleware
 */
class VerifyAccount
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
        if(!Auth::guard($guard)->user()->verified)
        {
            return redirect($guard . 's/verify');
        }

        return $next($request);
    }
}
