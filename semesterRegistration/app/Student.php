<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student, this model corresponds
 * to 'students' database table
 *
 * @package App
 */
class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'rollNo';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = [
        'rollNo', 'dCode', 'semNo', 'registrationNo', 'sectionId',
        'name', 'fatherName', 'motherName', 'email', 'phoneNo',
        'currentAddress', 'permanentAddress', 'password', 'dob',
    ];

    protected $hidden = [
        'password', 'remember_token'
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
}
