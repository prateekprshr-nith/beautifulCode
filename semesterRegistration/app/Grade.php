<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Grade, this model corresponds
 * to 'grades' database table
 *
 * @package App
 */
class Grade extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'rollNo';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = [
        'rollNo', 'sem1', 'sem2', 'sem3', 'sem4', 'sem5',
        'sem6', 'sem7', 'sem8', 'sem9', 'sem10', 'sgpi',
    ];


    /**
     * Model relationships
     *
     * These functions define the relationship of
     * this model with other models, and takes
     * care of how related data is retrived
     */

    /**
     * Get the student related to this grade row
     * Student 1 : 1 Grade
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student', 'rollNo', 'rollNo');
    }
}
