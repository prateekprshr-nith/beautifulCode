<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class FirstLogin, this class handles the
 * redirection of staff members and
 * teachers, if logging for first
 * the first time.
 *
 * @package App\Http\Middleware
 */
class FirstLogin
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
        if(Auth::guard($guard)->user()->firstLogin)
        {
            return redirect($guard . 's/firstLogin');
        }

        return $next($request);
    }
}
