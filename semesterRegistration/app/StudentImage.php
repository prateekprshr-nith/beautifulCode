<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentImage, this model corresponds
 * to 'studentImages' database table
 *
 * @package App
 */
class StudentImage extends Model
{
    protected $table = 'studentImages';
    protected $primaryKey = 'rollNo';
    public $incrementing = false;

    // Fillable and hidded attributes
    protected $fillable = [
        'rollNo', 'image'
    ];
}