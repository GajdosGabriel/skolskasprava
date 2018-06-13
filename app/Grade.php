<?php

namespace App;

use App\Notifications\Worker\ClassLeaderWasChanged;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'class_leader');
    }

    // Ukáže všetkých žiakov v triede
    public function users()
    {
        return $this->hasMany(User::class)->latest();
    }

    // Triedy ktoré patria userovi
    public function scopeGradeOfUser($query)
    {
        return $query->whereOwnerId(\Auth::user()->owner_id);
    }

    // Update class Leader ---------------------------------
    public function updateClassleader($data)
    {
        if($data['class_leader'] != $this->class_leader )
        {
            $this->getClassleaderUser($data['class_leader']);
        }
        $this->update($data);
    }

    protected function getClassleaderUser($findClassLeaderId)
    {
        $newClassLeader = User::whereId($findClassLeaderId)->first();
        $this->sendClassLeaderNotification($newClassLeader);
    }

    protected function sendClassLeaderNotification($user)
    {
        \Notification::send($user, new ClassLeaderWasChanged($this));
    }
    // End Update class Leader ---------------------------------



    public function students()
    {
        return $this->hasMany(User::class, 'grade_id');
    }

    public function classleader()
    {
        return $this->belongsTo(User::class, 'class_leader');
    }


}
