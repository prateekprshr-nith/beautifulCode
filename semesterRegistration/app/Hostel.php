<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hostel, this model corresponds
 * to 'hostels' databse table
 *
 * @package App
 */
class Hostel extends Model
{
    protected $table = 'hostels';
    protected $primaryKey = 'hostelId';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = ['hostelId', 'name'];


    /**
     * Model relationships
     *
     * These functions define the relationship of
     * this model with other models, and takes
     * care of how related data is retrived
     */

    /**
     * Get the staff of this hostel
     * Hostel 1 : many HostelStaff
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staffs()
    {
        return $this->hasMany('App\HostelStaff', 'hostelId', 'hostelId');
    }
}
