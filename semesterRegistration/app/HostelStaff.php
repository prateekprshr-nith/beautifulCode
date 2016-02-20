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
}
