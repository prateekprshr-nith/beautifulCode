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
}
