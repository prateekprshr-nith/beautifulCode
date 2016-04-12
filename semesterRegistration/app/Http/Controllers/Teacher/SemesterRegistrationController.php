<?php

namespace App\Http\Controllers\Teacher;

use App\Course;
use App\Teacher;
use App\Http\Requests;
use App\AvailableCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class SemesterRegistrationController, this class contains
 * all the logic for student semester registration process
 * 
 * @package App\Http\Controllers
 */
class SemesterRegistrationController extends Controller
{
    // Views dealing with semester registration
    protected $semesterSelectionView = 'teacher.semesterRegistration.semester';
    protected $courseSelectionView = 'teacher.semesterRegistration.courses';
    protected $inactiveView = 'common.inactive';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->middleware('firstLogin:teacher');
    }

    //------------------------------------------------------------------------------------------------------------------
    // Registration as an incharge and course management functions

    /**
     * Show semester selection view
     * 
     * @return mixed
     */
    public function showSemesterSelectionView()
    {
        if(!file_exists(storage_path() . '/app/activeForStaff'))
        {
            return view($this->inactiveView);
        }

        return view($this->semesterSelectionView);
    }

    /**
     * Show course selection view
     *
     * @return mixed
     */
    public function showCourseSelectionView ()
    {
        if(!file_exists(storage_path() . '/app/activeForStaff'))
        {
            return view($this->inactiveView);
        }

        // Get the semester
        $semNo = Auth::guard('teacher')->user()->semNo;

        /*
         * Check if the semeseter is null. If it
         * is null, then course selection form
         * should be in-active and semester
         * selection form should be active
         */
        if($semNo === null)
        {
            return view($this->semesterSelectionView);
        }
        else
        {
            // Get the courses already entered
            $availableCourses = AvailableCourse::where('semNo', $semNo)
                ->where('dCode', Auth::guard('teacher')->user()->dCode)
                ->get();

            $availableCourseCodes = [];
            foreach ($availableCourses as $availableCourse)
            {
                array_push($availableCourseCodes, $availableCourse->courseCode);
            }

            // Get the courses for the semester
            $courses = Course::where('semNo', $semNo)
                ->whereNotIn('courseCode', $availableCourseCodes)
                ->get();

            return view($this->courseSelectionView, [
                'courses' => $courses,
                'availableCourses' => $availableCourses,
                'count' => 0,
            ]);
        }
    }

    /**
     * Set / update teachers semester
     *
     * @param Request $request
     * @return mixed
     */
    public function addSemester (Request $request)
    {
        $this->validate($request, [
            'semNo' => 'required|numeric|min:1|unique:teachers,semNo,NULL,id,dCode,' . Auth::guard('teacher')->user()->dCode,
        ], [
            'unique' => 'This semester is already allocated'
        ]);

        $semNo = $request['semNo'];

        $teacher = Teacher::find(Auth::guard('teacher')->user()->facultyId);
        $teacher->semNo = $semNo;
        $teacher->save();

        return redirect()->back();
    }

    /**
     * Add an availble course for the semester
     * 
     * @param Request $request
     * @return mixed
     */
    public function addCourse (Request $request)
    {
        $availableCourse = [
            'courseCode' => $request['courseCode'],
            'dCode' => Auth::guard('teacher')->user()->dCode,
            'semNo' => Auth::guard('teacher')->user()->semNo,
        ];

        AvailableCourse::create($availableCourse);

        return redirect()->back();
    }

    /**
     * Remove a course
     *
     * @param Request $request
     * @return mixed
     */
    public function removeCourse (Request $request)
    {
        $course = [
            'dCode' => Auth::guard('teacher')->user()->dCode,
            'semNo' => Auth::guard('teacher')->user()->semNo,
            'courseCode' => $request['courseCode'],
        ];

        // Remove the course
        $course = AvailableCourse::where($course)->delete();

        return redirect()->back();
    }
}