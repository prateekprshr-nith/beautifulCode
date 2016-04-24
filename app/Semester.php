<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Semester, this model corresponds
 * to 'semesters' database table
 *
 * @package App
 */
class Semester extends Model
{
    protected $table = 'semesters';
    protected $primaryKey = 'semNo';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = ['semNo'];


    /**
     * Model relationships
     *
     * These functions define the relationship of
     * this model with other models, and takes
     * care of how related data is retrived
     */

    /**
     * Get the students of this semester
     * Semester 1 : many Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Student', 'semNo', 'semNo');
    }
}
