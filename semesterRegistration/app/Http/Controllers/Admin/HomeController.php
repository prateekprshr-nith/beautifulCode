<?php

namespace App\Http\Controllers\Admin;

use App\ChiefWardenStaff;
use App\Hostel;
use App\Teacher;
use App\Student;
use App\Section;
use App\Department;
use App\AdminStaff;
use App\HostelStaff;
use App\LibraryStaff;
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
     * and currently registered teachers
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageTeachers()
    {
        $teacherArr = Teacher::all();
        $departmentArr = Department::all();
        return view('teacher.auth.register',
            ['teachers' => $teacherArr, 'count' => 0, 'departments' => $departmentArr]);
    }

    /**
     * Remove a teacher
     *
     * @param $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function removeTeacher($id)
    {
        if ($id != null)
        {
            Teacher::destroy($id);
        }

        return redirect('admins/manage/teachers');
    }

    /**
     * Show the libraryStaff registration form
     * and currently registered libraryStaff
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageLibraryStaffs()
    {
        $libraryStaffArray = LibraryStaff::all();
        return view('libraryStaff.auth.register', ['libraryStaffs' => $libraryStaffArray, 'count' => 0]);
    }

    /**
     * Remove a libraryStaff
     *
     * @param $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function removeLibraryStaff($id)
    {
        if ($id != null)
        {
            LibraryStaff::destroy($id);
        }

        return redirect('admins/manage/libraryStaffs');
    }

    /**
     * Show the adminStaff registration form
     * and currently registered adminStaff
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageAdminStaffs()
    {
        $adminStaffArr = AdminStaff::all();
        return view('adminStaff.auth.register', ['adminStaffs' => $adminStaffArr, 'count' => 0]);
    }

    /**
     * Remove an adminStaff
     *
     * @param $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function removeAdminStaff($id)
    {
        if ($id != null)
        {
            AdminStaff::destroy($id);
        }

        return redirect('admins/manage/adminStaffs');
    }

    /**
     * Show the chiefWardenStaff registration form
     * and currently registered adminStaff
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageChiefWardenStaffs()
    {
        $chiefWardenStaffArr = ChiefWardenStaff::all();
        return view('chiefWardenStaff.auth.register', ['chiefWardenStaffs' => $chiefWardenStaffArr, 'count' => 0]);
    }

    /**
     * Remove an chiefWardenStaff
     *
     * @param $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function removeChiefWardenStaff($id)
    {
        if ($id != null)
        {
            ChiefWardenStaff::destroy($id);
        }

        return redirect('admins/manage/chiefWardenStaffs');
    }

    /**
     * Show the hostelStaff registration form
     * and currently registered hostelStaff
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageHostelStaffs()
    {
        $hostelStaffArr = HostelStaff::all();
        $hostelArr = Hostel::all();
        return view('hostelStaff.auth.register',
            ['hostelStaffs' => $hostelStaffArr, 'count' => 0, 'hostels' => $hostelArr]);
    }

    /**
     * Remove a hostelStaff
     *
     * @param $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function removeHostelStaff($id)
    {
        if ($id != null)
        {
            HostelStaff::destroy($id);
        }

        return redirect('admins/manage/hostelStaffs');
    }

    /**
     * Show the currently registered students
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageStudents()
    {
        $studentArr = Student::all();
        return view('admin.manage.students', ['students' => $studentArr, 'count' => 0]);
    }

    /**
     * Manually verify a student
     *
     * @param $rollNo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifyStudent ($rollNo)
    {
        if($rollNo != null)
        {
            $student = Student::find($rollNo);
            $student->verified = true;
            $student->save();
        }

        return redirect('admins/manage/students');
    }

    /**
     * Remove a student
     *
     * @param $rollNo
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function removeStudent($rollNo)
    {
        if ($rollNo != null)
        {
            Student::destroy($rollNo);
        }

        return redirect('admins/manage/students');
    }

    /**
     * Show the departments currently present in the database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageDepartments()
    {
        $departmentArr = Department::all();
        return view('admin.manage.departments', ['departments' => $departmentArr, 'count' => 0]);
    }

    /**
     * Add a department
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addDepartment (Request $request)
    {
        $dCode = $request['dCode'];
        $dName = $request['dName'];

        Department::create(['dCode' => $dCode, 'dName' => $dName]);

        return redirect()->back()
            ->with('status', 'Success');
    }

    /**
     * Remove a deparement
     *
     * @param $dCode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeDepartment ($dCode)
    {
        if($dCode != null)
        {
            Department::destroy($dCode);
        }

        return redirect()->back();
    }

    /**
     * Show the sections currently present in the database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageSections()
    {
        $sectionArr = Section::all();
        $departmentArr = Department::all();

        return view('admin.manage.sections',
            ['sections' => $sectionArr, 'count' => 0, 'departments' => $departmentArr]);
    }

    /**
     * Add a section
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSection (Request $request)
    {
        $sectionId = $request['sectionId'];
        $dCode = $request['dCode'];

        Section::create(['sectionId' => $sectionId, 'dCode' => $dCode]);

        return redirect()->back()
            ->with('status', 'Success');
    }

    /**
     * Remove a section
     *
     * @param $sectionId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeSection ($sectionId)
    {
        if($sectionId != null)
        {
            Section::destroy($sectionId);
        }

        return redirect()->back();
    }

    /**
     * Show the hostels currently present in the database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manageHostels()
    {
        $hostelArr = Hostel::all();
        return view('admin.manage.hostels', ['hostels' => $hostelArr, 'count' => 0]);
    }

    /**
     * Add a hostel
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addHostel (Request $request)
    {
        $hostelId = $request['hostelId'];
        $name = $request['name'];

        Hostel::create(['hostelId' => $hostelId, 'name' => $name]);

        return redirect()->back()
            ->with('status', 'Success');
    }

    /**
     * Remove a hostel
     *
     * @param $hostelId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeHostel ($hostelId)
    {
        if($hostelId != null)
        {
            Hostel::destroy($hostelId);
        }

        return redirect()->back();
    }
}

