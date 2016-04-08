<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class LibraryStaff, this model corresponds
 * to 'libraryStaffs' database table
 *
 * @package App
 */
class LibraryStaff extends Authenticatable
{
    protected $table = 'libraryStaffs';
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
