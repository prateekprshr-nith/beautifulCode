<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class HomeController, this class contains all the methods
 * for admin tasks like creating a new {teacher, library
 * staff, hostel staff, admin staff} account, adding
 * new {department, section} and other tasks.
 *
 * @package App\Http\Controllers\Admin
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
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    /**
     * Show the teacher registration form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageTeachers()
    {
        return view('teacher.auth.register');
    }

    /**
     * Show the libraryStaff registration form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageLibraryStaff()
    {
        return view('libraryStaff.auth.register');
    }

    /**
     * Show the adminStaff registration form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageAdminStaff()
    {
        return view('adminStaff.auth.register');
    }

    /**
     * Show the hostelStaff registration form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageHostelStaff()
    {
        return view('hostelStaff.auth.register');
    }
}
