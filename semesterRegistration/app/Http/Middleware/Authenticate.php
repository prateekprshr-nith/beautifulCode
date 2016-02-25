<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson())
            {
                return response('Unauthorized.', 401);
            } elseif($guard == 'student')   // Redirect if student
            {
                return redirect()->guest('/students/login');
            }

            /*
             * More conditions for others
             */
        }

        return $next($request);
    }
}
