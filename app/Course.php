<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Course, this model for our courses table
 *
 * @package App
 */
class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'courseCode';
    public $incrementing = false;

    // Fillabe attributes
    protected $fillable = [
        'courseCode', 'dCode', 'courseName',
        'semNo', 'lectures', 'tutorials',
        'practicals', 'credits', 'openElective',
        'departmentElective',
    ];

    /**
     * Get the department of the course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department', 'dCode', 'dCode');
    }

    /**
     * Get the allocated electives with this course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allocatedElectives ()
    {
        return $this->hasMany('App\AllocatedElective', 'courseCode', 'courseCode');
    }
}
