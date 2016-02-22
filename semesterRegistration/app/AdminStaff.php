<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminStaff, this model corresponds
 * to 'adminStaffs' databse table
 *
 * @package App
 */
class AdminStaff extends Model
{
    protected $table = 'adminStaffs';
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
