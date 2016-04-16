<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CurrentStudentState, this model corresponds
 * to createStudentStates database table
 *
 * @package App
 */
class CurrentStudentState extends Model
{
    protected $table = 'currentStudentStates';
    protected $primaryKey = 'rollNo';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = [
        'rollNo', 'semNo', 'hostler', 'feeReceipt', 'step',
    ];

    /**
     * Get the student associated with the record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student ()
    {
        return $this->belongsTo('App\Student', 'rollNo', 'rollNo');
    }
}
