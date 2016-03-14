<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * Class AdminStaff, this model corresponds
 * to 'adminStaffs' databse table
 *
 * @package App
 */
class AdminStaff extends Authenticatable
{
    protected $table = 'adminStaffs';
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
