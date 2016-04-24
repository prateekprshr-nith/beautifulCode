<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminStaffRequest, this model corresponds
 * to 'adminStaffRequests' database table
 * 
 * @package App
 */
class AdminStaffRequest extends Model
{
    protected $table = 'adminStaffRequests';
    protected $primaryKey = 'rollNo';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $fillable = [
        'rollNo', 'status', 'remarks',
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
