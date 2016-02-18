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
}
