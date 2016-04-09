<?php

namespace App\Http\Controllers\DepartmentStaff;

use App\Course;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController, this class contains
 * all the methods for departmentStaff tasks like
 * semester registration, profile update
 * and all others that are left
 *
 * @package App\Http\Controllers\DepartmentStaff
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
        $this->middleware('auth:departmentStaff');
        $this->middleware('firstLogin:departmentStaff');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the list of courses
        $courses = Course::where('dCode', Auth::guard('departmentStaff')->user()->dCode)->get();

        // Department code
        $dCode = Auth::guard('departmentStaff')->user()->dCode;

        return view('departmentStaff.home', ['courses' => $courses, 'count' => 0, 'dCode' => $dCode]);
    }

    /**
     * Add a new course
     *
     * @param Request $request
     * @return mixed
     */
    public function addCourse (Request $request)
    {
        $this->validate($request, [
            'courseCode' => 'required|unique:courses',
            'courseName' => 'required',
        ], [
            'unique' => 'This course is already present in the database'
        ]);

        $course = [
            'courseCode' => $request['courseCode'],
            'dCode' => Auth::guard('departmentStaff')->user()->dCode,
            'courseName' => $request['courseName'],
        ];

        // Save the course
        Course::create($course);

        return redirect()->back()
            ->with('status', 'Success');
    }

    /**
     * Remove a course
     *
     * @param Request $request
     * @return mixed
     */
    public function removeCourse (Request $request)
    {
        $courseCode = $request['courseCode'];

        // Remove the course
        Course::destroy($courseCode);

        return redirect()->back();
    }
}
