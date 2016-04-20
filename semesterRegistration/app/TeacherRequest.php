<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeacherRequest, this model corresponds
 * to the 'teacherRequests' database table
 *
 * @package App
 */
class TeacherRequest extends Model
{
    protected $table = 'teacherRequests';
    protected $primaryKey = 'rollNo';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = [
        'rollNo', 'status', 'imagePath', 'remarks',
    ];

    /**
     * Get the student associated with this request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student ()
    {
        return $this->belongsTo('App\Student', 'rollNo', 'rollNo');
    }
}
