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
}
