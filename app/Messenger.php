<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Messenger extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFormatCreatedAtAttribute()
    {
        return date('j. M Y', strtotime( $this->created_at ));
    }
}
