<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class DepartmentStaff extends Authenticatable
{
    protected $table = 'departmentStaffs';
    protected $primaryKey = 'id';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = [
        'id', 'name', 'email', 'dCode', 'password', 'firstLogin',
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
     * Get the department of this departmentStaff
     * Department 1 : many DepartmentStaff
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department', 'dCode', 'dCode');
    }
}
