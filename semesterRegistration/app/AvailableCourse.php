<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AvailableCourse, this model for our availableCourses table
 * @package App
 */
class AvailableCourse extends Model
{
    protected $table = 'availableCourses';
    protected $primaryKey = ['dCode', 'semNo', 'courseCode'];
    public $incrementing = false;

    // Fillabe attributes
    protected $fillable = [
        'courseCode', 'dCode', 'semNo',
    ];

    /**
     * Get the course details
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courseDetail ()
    {
        return $this->belongsTo('App\Course', 'courseCode', 'courseCode');
    }
}
