<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $guarded = [];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
