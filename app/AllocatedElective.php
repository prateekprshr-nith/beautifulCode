<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllocatedElective extends Model
{
    protected $table = 'allocatedElectives';
    protected $primaryKey = ['rollNo', 'courseCode'];
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = ['rollNo', 'courseCode'];

    /**
     * Get the current student state
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currentStudentState ()
    {
        return $this->belongsTo('App\CurrentStudentState', 'rollNo', 'rollNo');
    }

    /**
     * Get the course details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course ()
    {
        return $this->belongsTo('App\Course', 'courseCode', 'courseCode');
    }
}
