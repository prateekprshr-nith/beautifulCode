<?php

namespace App\Http\Middleware;

use Closure;
use App\StudentImage;
use Illuminate\Support\Facades\Auth;

/**
 * Class UploadImage, this class handles
 * the redirection of students, in case
 * they have not uploaded their image.
 *
 * @package App\Http\Middleware
 */
class UploadImage
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
        $rollNo = Auth::guard('student')->user()->rollNo;

        if((StudentImage::find($rollNo) == null) && !$request->session()->has('imageUploadSkipped'))
        {
            return redirect('/students/updateInfo/image');
        }
        
        return $next($request);
    }
}
