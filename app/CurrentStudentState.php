<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'rollNo', 'semNo', 'hostler', 'feeReceipt', 'loanCase','hostelId', 'step', 'approved', 'verificationCode',
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

    /**
     * Get the hostel associated with this request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hostel ()
    {
        return $this->belongsTo('App\Hostel', 'hostelId', 'hostelId');
    }
}
