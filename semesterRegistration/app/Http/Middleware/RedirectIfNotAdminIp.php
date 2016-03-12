<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class RedirectIfNotAdminIp, this class handles
 * the redirection of the users if they try to
 * access the admin routes from an invalid IP.
 *
 * @package App\Http\Middleware
 */
class RedirectIfNotAdminIp
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
        if($request->ip() != env('ADMIN_IP', '127.0.0.1'))
        {
            return redirect('/');
        }

        return $next($request);
    }
}