<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Teacher, this model corresponds
 * to 'teachers' database model
 *
 * @package App
 */
class Teacher extends Model
{
    protected $table = 'teaachers';
    protected $primaryKey = 'facultyId';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = [
        'facultyId', 'dCode', 'name', 'email', 'office',
        'semester', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
