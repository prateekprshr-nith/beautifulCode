<?php

namespace App\Http\Middleware;

use Closure;

use App\StudentImage;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfImageUploaded, this class handles
 * the redirection of students if they have
 * already uploaded their image.
 *
 * @package App\Http\Middleware
 */
class RedirectIfImageUploaded
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
        if(Auth::guard('student')->check())
        {
            $rollNo = Auth::guard('student')->user()->rollNo;

            if((StudentImage::find($rollNo) != null) || $request->session()->has('imageUploadSkipped'))
            {
                return redirect('/students/home');
            }
        }

        return $next($request);
    }
}
