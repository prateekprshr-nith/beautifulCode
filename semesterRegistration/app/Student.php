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
}
