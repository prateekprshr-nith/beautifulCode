<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Common views for all users
    protected $inactiveView = 'common.inactive';

    /**
     * This function checks if the registration
     * is active for a particular type of user
     *
     * @param $user
     * @return bool
     */
    protected function isRegistrationActive ($user)
    {
        if($user === 'student')
        {
            $filename = storage_path() . '/app/activeForStudents';
        }
        else
        {
            $filename = storage_path() . '/app/activeForStaff';
        }
        
        if(file_exists($filename))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
