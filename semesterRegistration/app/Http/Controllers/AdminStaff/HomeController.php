<?php

namespace App\Http\Controllers\AdminStaff;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class HomeController, this class contains
 * all the methods for adminStaff tasks like
 * semester registration, profile update
 * and all others that are left
 *
 * @package App\Http\Controllers\AdminStaff
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:adminStaff');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminStaff.home');
    }
}
