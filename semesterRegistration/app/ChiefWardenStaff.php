<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * Class ChiefWardenStaff, this model corresponds
 * to 'chiefWardenStaffs' databse table
 *
 * @package App
 */
class ChiefWardenStaff extends Authenticatable
{
    protected $table = 'chiefWardenStaffs';
    protected $primaryKey = 'id';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = [
        'id', 'name', 'email', 'password', 'firstLogin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
