<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HostelStaffRequest, this model corresponds
 * to 'hostelStaffRequests' database table
 *
 * @package App
 */
class HostelStaffRequest extends Model
{
    protected $table = 'hostelStaffRequests';
    protected $primaryKey = 'rollNo';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = [
        'rollNo', 'hostelId', 'status', 'remarks',
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

    /**
     * Get the hostel details associated with this request
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hostel ()
    {
        return $this->belongsTo('App\Hostel', 'hostelId', 'hostelId');
    }
}
