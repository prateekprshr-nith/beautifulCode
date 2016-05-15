<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ChiefWardenStaffRequest, this model corresponds
 * to 'chiefWardenStaffRequests' database table
 *
 * @package App
 */
class ChiefWardenStaffRequest extends Model
{
    protected $table = 'chiefWardenStaffRequests';
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
