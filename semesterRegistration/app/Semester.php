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
}
