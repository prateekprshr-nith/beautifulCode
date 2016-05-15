<?php

namespace App\Http\Controllers\Teacher;

use App;
use App\Course;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController, this class contains
 * all the methods for teacher tasks like
 * semester registration, profile update
 * and all others that are left
 *
 * @package App\Http\Controllers\Teacher
 */
class HomeController extends Controller
{
    protected $helpView = 'teacher.help';
    protected $electiveSelectionView = 'teacher.electives';

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.home');
    }

    public function showElectiveSelectionView()
    {
        // Get electives
        $electives = Course::where('dCode', Auth::guard('teacher')->user()->dCode)
            ->where(function($q) {
                $q->where('openElective', true)->orWhere('departmentElective', true);
            })->get();

        return view($this->electiveSelectionView, ['electives' => $electives]);
    }

    public function getElectiveList ($courseCode)
    {
        // Get the list of allocated electives
        $allocatedElectives = Course::find($courseCode)->allocatedElectives;

        if($allocatedElectives->isEmpty())
        {
            $studentList = 'No student has opted for this subject !!!';
        }
        else
        {
            $studentList = '';
            $count = 1;

            // Generate the student list
            foreach ($allocatedElectives as $allocatedElective)
            {
                $studentList = $studentList . "\n" . $count . ") " .
                    $allocatedElective->rollNo . ", " .
                    $allocatedElective->currentStudentState->student->name  . ", " .
                    $allocatedElective->currentStudentState->student->department->dName;
            }
        }

        $list = App::make('snappy.pdf.wrapper');
        $list->loadHTML($studentList)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-top', 10);

        return $list->download($courseCode . 'List.pdf');
    }
}
