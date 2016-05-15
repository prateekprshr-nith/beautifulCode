<?php

namespace App\Http\Controllers\LibraryStaff;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class HomeController, this class contains
 * all the methods for libraryStaff tasks like
 * semester registration, profile update
 * and all others that are left
 *
 * @package App\Http\Controllers\LibraryStaff
 */
class HomeController extends Controller
{
    protected $helpView = 'libraryStaff.help';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:libraryStaff');
        $this->middleware('firstLogin:libraryStaff');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('libraryStaff.home');
    }
}
