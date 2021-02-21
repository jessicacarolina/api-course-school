<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'description', 'dt_start', 'school_id',
    ];

    public function schools() {
        return $this->belongsToMany(School::class);
    }
}
