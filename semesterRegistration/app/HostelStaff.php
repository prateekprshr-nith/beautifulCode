<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HostelStaff, this model corresponds
 * to 'hostelStaffs' database table
 *
 * @package App
 */
class HostelStaff extends Model
{
    protected $table = 'hostelStaffs';
    protected $primaryKey = 'id';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = [
        'id', 'hostelId', 'name', 'email', 'password',
    ];

     protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Model relationships
     *
     * These functions define the relationship of
     * this model with other models, and takes
     * care of how related data is retrived
     */

    /**
     * Get the hostel of this staff member
     * Hostel 1 : many HostelStaff
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hostel()
    {
        return $this->belongsTo('App\Hostel', 'hostelId', 'hostelId');
    }
}
