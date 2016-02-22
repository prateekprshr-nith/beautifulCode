<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LibraryStaff, this model corresponds
 * to 'libraryStaffs' database table
 *
 * @package App
 */
class LibraryStaff extends Model
{
    protected $table = 'libraryStaffs';
    protected $primaryKey = 'id';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = [
        'id', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
