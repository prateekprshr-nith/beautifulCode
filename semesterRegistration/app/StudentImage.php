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
        'rollNo', 'imagePath'
    ];


    /**
     * Model relationships
     *
     * These functions define the relationship of
     * this model with other models, and takes
     * care of how related data is retrived
     */

    /**
     * Get the student related to this image row
     * Student 1 : 1 StudentImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo('App\Student', 'rollNo', 'rollNo');
    }
}