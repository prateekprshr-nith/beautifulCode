<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Department, this model corresponds
 * to 'departments' databse table
 *
 * @package App
 */
class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'dCode';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = [
        'dCode', 'dName'
    ];


    /**
     * Model relationships
     *
     * These functions define the relationship of
     * this model with other models, and takes
     * care of how related data is retrived
     */

    /**
     * Get the sections of this department
     * Department 1 : many Section
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany('App\Section', 'dCode', 'dCode');
    }

    /**
     * Get the teachers of this department
     * Department 1 : many Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teachers()
    {
        return $this->hasMany('App\Teacher', 'dCode', 'dCode');
    }

    /**
     * Get the students of this department
     * Department 1 : many Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Student', 'dCode', 'dCode');
    }




}
