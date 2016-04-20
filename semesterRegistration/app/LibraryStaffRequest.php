<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LibraryStaffRequest, this model corresponds
 * to 'libraryStaffRequests' database table
 * 
 * @package App
 */
class LibraryStaffRequest extends Model
{
    protected $table = 'libraryStaffRequests';
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
