<?php

namespace App;

use App\Student;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;

use App\Notifications\Worker\WorkerResetPasswordNotification;
use App\Notifications\Worker\WorkerInvitationNotification;
use App\Notifications\Parent\ConfirmStudentAgreement;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'company', 'street', 'psc', 'ico', 'dic', 'phone', 'city', 'filename', 'slug', 'bankName',
        'bankNoAccount', 'bankNoAccountIban','invitation', 'admin','tutorial', 'owner_id', 'role', 'confirmed', 'parent_id', 'grade_id', 'owner_id'
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function sendInvitation($user)
    {
        $user->update(['invitation' => 1]);

        $this->notify(new WorkerInvitationNotification($this));
        \Toastr::success('Odoslané!', 'Pozvánka bola odoslaná.', ["positionClass" => "toast-bottom-right"]);

    }

    public function sendStudentInvitation($user)
    {
        $this->update(['invitation' => 1]);

        $user->notify( new ConfirmStudentAgreement($user));

        \Toastr::success('Odoslané!', 'Pozvánka rodičovi bola odoslaná.', ["positionClass" => "toast-bottom-right"]);

    }

    public function sendParentInvitation($user)
    {
        $user->update(['invitation' => 1]);
        $parent = $user->parent($user->parent_id);

        $parent->notify( new ConfirmStudentAgreement($parent));

        \Toastr::success('Odoslané!', 'Pozvánka rodičovi bola odoslaná.', ["positionClass" => "toast-bottom-right"]);

    }

    public function isSuperAdmin() {
        return in_array($this->email, config('skolskaSprava.administrators'));
    }




    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


    public function grade()
    {
        return $this->hasOne(Grade::class, 'class_leader');
    }

//    Pre admin tabuľku
    public function grades()
    {
        return $this->hasMany(Grade::class, 'class_leader');
    }

//    Študentovi zobrazuje triedu
    public function trieda()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    public function scopeIsClassLeader()
    {
        return $this->grade()->where()->contains('class_leader', auth()->user()->id);
    }

//    Do emailou poslať adresu vlastníka účtu
    public function scopeOwner($query, $id)
    {
        return $query->whereId($id)->first();
    }


    public function messengers()
    {
        return $this->hasMany(Messenger::class);
    }

    public function haveNewMessage()
    {
      return  $this->messengers()->where('read_at', null)->exists();
    }

  public function userRequested()
    {
        return $this->hasMany(Messenger::class, 'requested_user');
    }

    // Pre messenger miesto obrázka
    public function firstLettersName()
    {
        return substr($this->attributes['first_name'], 0, 1) . substr($this->attributes['last_name'], 0, 1);
    }



    public function tutorials()
    {
        return $this->belongsToMany(Tutorial::class);
    }

    public function markTutorial($id)
    {

       if(! $this->tutorials()->whereId($id)->exists() ) {
           return $this->tutorials()->attach($id);
       }
    }


    public function scopeParent($query, $id)
    {
        return $query->whereId($id)->first();
    }


    public function scopeCountStudents($query, $id)
    {
        return $query->whereParentId($id)->count();
    }

    public function scopeHasStudents($query, $id)
    {
        return $query->whereParentId($id)->exists();
    }

    public function scopeParentListOfStudents($query, $id)
    {
       return $query->whereParentId($id)->get();
    }



    public function hasParentEmail($id)
    {
          $user = $this->whereId($id)->first();

        if(str_contains($user->email, '@')) {
            return true;
        }

        return false;
    }

    public function scopeTriedny($query, $id)
    {
        return $query->whereGradeId($id)->exists();
    }




    public function agreements()
    {
        return $this->belongsToMany(Agreement::class)->withPivot('created_at', 'updated_at');
    }

    public function agreement($id)
    {
        return $this->agreements()->whereId($id)->exists();
    }




    /**
     * Create slug from title before storing to DB
     *
     * @param $value
     */
    public function setCompanyAttribute($value)
    {
        $this->attributes['company'] =  ucfirst($value);
        $this->attributes['slug']  = str_slug($value);
    }


    // Uloží základne parametre pre parents a students
    public function setFirstNameAttribute()
    {
        $this->attributes['slug']  = str_slug(request('first_name') . '-' . request('last_name') );
        $this->attributes['owner_id']  =  auth()->user()->owner_id;
    }


    public function getDateInAttribute( $value )
    {
        return date('j M Y', strtotime( $value ));
    }


    public function getCreatedAtAttribute( $value )
    {
        return date('j M Y', strtotime( $value ));
    }


    public function full_name()
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function full_name_reverse()
    {
        return $this->last_name .' '. $this->first_name;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

//    /**
//     * @param string|array $roles
//     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
            abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
        abort(401, 'This action is unauthorized.');
    }

//    /**
//     * Check multiple roles
//     * @param array $roles
//     */
    public function hasRoles(array $roles)
    {
        $result = $this->roles()->whereIn('id', $roles)->get();
        return (count($roles) == count($result)) ? true : false;
    }

    //Ak má užívateľ niektorú z roly polia []
    public function hasAnyRoles(array $roles)
    {
        return $this->roles()->whereIn('id', $roles)->exists();
//        return (count($roles) !== count($result)) ? true : false;
    }

    /**
     * Check one role
     *
     * @param int $role
     * @return null|Role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->whereId($role)->first();
    }

    /**
     * Create slug from title before storing to DB
     *
     * @param string $title
     */
    public function haveTutorial(string $tutorial)
    {
        return ! $this->tutorials()->whereSlug($tutorial)->exists();
    }

// Count of number of workers, that admin add new one
    public function scopeCountOfWorkers($query)
    {
        return $query->whereOwnerId(auth()->user()->owner_id)->whereHas('roles', function ($query) {
            $query->where('id', '=', 2);
        })->count();
    }


//    public function getCanSeeEmailAttribute()
//    {
//        $admin = $this->hasRole(1);
//        $owner = ($this->email == auth()->user()->email) ? true : false;
//
//        return ($admin || $owner) ? $this->email : '*****';
//    }



}
