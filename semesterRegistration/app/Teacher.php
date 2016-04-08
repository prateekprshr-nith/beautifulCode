<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Teacher, this model corresponds
 * to 'teachers' database model
 *
 * @package App
 */
class Teacher extends Authenticatable
{
    protected $table = 'teachers';
    protected $primaryKey = 'facultyId';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = [
        'facultyId', 'dCode', 'name', 'email', 'office',
        'semester', 'password', 'firstLogin',
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
     * Get the department of this teacher
     * Department 1 : many Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department', 'dCode', 'dCode');
    }
}
