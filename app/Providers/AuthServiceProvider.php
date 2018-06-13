<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
//        User::class => UsersPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::define('admin-edit', function($user) {
            return auth()->user()->hasRole(1);
        });

//        sku3obny
//        \Gate::define('can-i-see', function($user, $email) {
//            $admin = $user->hasRole(1);
//            $owner = ($email == $user->email) ? true : false;
//
//            return ($admin || $owner) ? true : false;
//        });


//        Rodič zobrazí len svoj účet/profil. Ostatný všetko.
        \Gate::define('show-parent', function($user, $slug)
        {
            if($user->hasRole(3)){
                return $user->slug == $slug;
            }
            return true;
        });


//        User môže etitovať len svoj profil okrem admina a učiteľa
        \Gate::define('user-update', function($user, $slug)
        {
            if($user->hasRole(3) ) {
                return $user->slug == $slug;

            }

            if($user->hasAnyRoles([1,2])) {
                return true;
            }
               return false;
        });



////Nefunguje dobre ide striedavo
         \Gate::define('worker-edit', function($user)
        {

            if( $user->scopeIsClassLeader() ) {
                return true;
            }

            return false;

        });




    }
}
