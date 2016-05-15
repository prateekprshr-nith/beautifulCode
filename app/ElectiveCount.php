<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ElectiveCount, this class corresponds
 * to electiveCounts database table
 * 
 * @package App
 */
class ElectiveCount extends Model
{
    protected $table = 'electiveCounts';
    protected $primaryKey = ['dCode', 'semNo'];
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = [
        'dCode', 'semNo', 'openElectives', 'departmentElectives',
    ];
}
