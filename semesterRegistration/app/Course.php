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
    protected $primaryKey = 'courseCode';
    public $incrementing = false;

    // Fillabe attributes
    protected $fillable = [
        'courseCode', 'dCode', 'courseName',
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
     * Get the teaching detail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teachingDetail()
    {
        return $this->hasOne('App\TeachingDetail', 'courseCode', 'courseCode');
    }
}
