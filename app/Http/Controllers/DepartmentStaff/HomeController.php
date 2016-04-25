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
    // Course management views
    protected $courseManagementView = 'departmentStaff.manage.courses';
    
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
        return view('departmentStaff.home');
    }

    //------------------------------------------------------------------------------------------------------------------
    // Course management routes

    /**
     * Show courses currently present in database
     *
     * @return mixed
     */
    public function manageCourses ()
    {
        // Get the list of courses
        $courses = Course::where('dCode', Auth::guard('departmentStaff')->user()->dCode)->get();

        // Department code
        $dCode = Auth::guard('departmentStaff')->user()->dCode;

        return view($this->courseManagementView, ['courses' => $courses, 'count' => 0, 'dCode' => $dCode]);
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
            'semNo' => 'required|numeric|min:1',
            'lectures' => 'required|numeric|min:0',
            'tutorials' => 'required|numeric|min:0',
            'practicals' => 'required|numeric|min:0',
            'credits' => 'required|numeric|min:1',
        ], [
            'unique' => 'This course is already present in the database'
        ]);
        
        if($request->has('departmentElective') && $request->has('openElective'))
        {
            return redirect()->back()
                ->with('errors', 'A course can not be an open and department elective at same time');
        }
        else
        {
            if($request->has('departmentElective'))
                $departmentElective = true;
            else
                $departmentElective = false;

            if($request->has('openElective'))
                $openElective = true;
            else
                $openElective = false;
        }
        
        $course = [
            'courseCode' => $request['courseCode'],
            'dCode' => Auth::guard('departmentStaff')->user()->dCode,
            'courseName' => $request['courseName'],
            'openElective' => $openElective,
            'departmentElective' => $departmentElective,
            'semNo' => $request['semNo'],
            'lectures' => $request['lectures'],
            'tutorials' => $request['tutorials'],
            'practicals' => $request['practicals'],
            'credits' => $request['credits'],
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
