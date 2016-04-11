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
        'practicals', 'hours', 'credits',
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
     * Get available courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function availableCourses ()
    {
        return $this->hasMany('App\AvailableCourse', 'dCode', 'dCode');
    }
}
