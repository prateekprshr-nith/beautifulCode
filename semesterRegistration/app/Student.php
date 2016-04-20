<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Student, this model corresponds
 * to 'students' database table
 *
 * @package App
 */
class Student extends Authenticatable
{
    protected $table = 'students';
    protected $primaryKey = 'rollNo';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = [
        'rollNo', 'dCode', 'semNo', 'registrationNo', 'sectionId',
        'name', 'fatherName', 'motherName', 'email', 'phoneNo',
        'currentAddress', 'permanentAddress', 'password', 'dob',
        'verificationCode', 'verified',
    ];

    protected $hidden = [
        'password', 'remember_token', 'verificationCode',
    ];


    /**
     * Model relationships
     *
     * These functions define the relationship of
     * this model with other models, and takes
     * care of how related data is retrived
     */

    /**
     * Get the department of this student
     * Department 1 : many Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department', 'dCode', 'dCode');
    }

    /**
     * Get the section of this student
     * Section 1 : many Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo('App\Section', 'sectionId', 'sectionId');
    }

    /**
     * Get the semester of this student
     * Semester 1 : many Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo('App\Semester', 'semNo', 'semNo');
    }

    /**
     * Get the grade of the student
     * Student 1 : 1 Grade
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function grade()
    {
        return $this->hasMany('App\Grade', 'rollNo', 'rollNo');
    }

    /**
     * Get the image of the student
     * Student 1 : 1 StudentImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne('App\StudentImage', 'rollNo', 'rollNo');
    }

    /**
     * Get the currentStudentState
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currentStudentState ()
    {
        return $this->hasOne('App\CurrentStudentState', 'rollNo', 'rollNo');
    }

    /**
     * Get the teacher request associated with this student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacherRequest ()
    {
        return $this->hasOne('App\TeacherRequest', 'rollNo', 'rollNo');
    }

    /**
     * Get the admin staff request associated with this student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function adminStaffRequest ()
    {
        return $this->hasOne('App\AdminStaffRequest', 'rollNo', 'rollNo');
    }

    /**
     * Get the library staff request associated with this student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function libraryStaffRequest ()
    {
        return $this->hasOne('App\LibraryStaffRequest', 'rollNo', 'rollNo');
    }

    /**
     * Get the chiefWarden staff request associated with this student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chiefWardenStaffRequest ()
    {
        return $this->hasOne('App\ChiefWardenStaffRequest', 'rollNo', 'rollNo');
    }

    /**
     * Get the hostel staff request associated with this student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hostelStaffRequest ()
    {
        return $this->hasOne('App\HostelStaffRequest', 'rollNo', 'rollNo');
    }
}