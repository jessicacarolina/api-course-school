<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name', 'city',
    ];

    public function courses() {
        return $this->belongsToMany(Course::class);
    }
}
