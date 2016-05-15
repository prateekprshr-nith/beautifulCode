<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Admin, this model corresponds
 * to 'admins' database table
 *
 * @package App
 */
class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $primaryKey = 'adminId';
    public $incrementing = false;

    // Fillable and hidden arrtibutes
    protected $hidden = [
        'password', 'remember_token'
    ];
}
