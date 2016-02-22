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
}
