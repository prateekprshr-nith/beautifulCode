<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Section, this model corresponds
 * to 'sections' database table
 *
 * @package App
 */
class Section extends Model
{
    protected $table = 'sections';
    protected $primaryKey = 'sectionId';
    public $incrementing = false;

    // Fillable and hidden attributes
    protected $fillable = [
        'sectionId', 'dCode',
    ];


    /**
     * Model relationships
     *
     * These functions define the relationship of
     * this model with other models, and takes
     * care of how related data is retrived
     */

    /**
     * Get the department of this section
     * Department 1 : many Section
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department', 'dCode', 'dCode');
    }

    /**
     * Get the students of this section
     * Section 1 : many Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Student', 'sectionId', 'sectionId');
    }
}
