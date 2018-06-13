<?php

namespace App\Providers;

use App\Messenger;
use Carbon\Carbon;
use App\Grade;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));

        \Schema::defaultStringLength(191);

        view()->composer('moduls.owner_info',  function($view) {
            $view->with('user', User::whereId(auth()->user()->owner_id )->firstOrFail() );
        });

        view()->composer(['grades.grades_list', 'students.edit',
            'students.create-modal', 'pages.tutorial.3_add_student' ],  function($view) {
            $view->with('grades', Grade::GradeOfUser()->orderBy('name', 'asc')->get() );
        });


        view()->composer(['grades.index', 'grades.edit'],  function($view) {
            $view->with('users', User::whereOwnerId( auth()->user()->owner_id )
                ->whereHas(
                    'roles', function($q){
                    $q->where('id', 2)
                        ->orWhere('id', 1);
                })->get() );
        });

        view()->composer('students.modal-add-parent',  function($view) {
            $view->with('parents', User::whereOwnerId( auth()->user()->owner_id )
                ->whereHas(
                    'roles', function($q){
                    $q->where('id', 3);
                })->orderBy('last_name', 'desc')->get() );
        });

        view()->composer(['messenger.index', 'messenger.show' ],  function($view) {
            $view->with('users', User::whereOwnerId( auth()->user()->owner_id )
                ->whereNotBetween('id', [auth()->user()->id, auth()->user()->id])
                ->whereHas(
                    'roles', function($q) {
                    $q->where('id', 2)
                        ->orWhere('id', 1);
                })->orderBy('last_name', 'asc')->paginate() );

            });


        view()->composer('messenger.list_of_users',  function($view) {
            $view->with('alladmins', User::
                whereHas(
                    'roles', function($q) {
                    $q->where('id', 1);
//                        ->orWhere('id', 1);
                })->orderBy('last_name', 'asc')->paginate() );

        });

        // Modul 1 messenger for parents riaditeľovi // admin
        view()->composer('messenger.parent-modul',  function($view) {
            $view->with('requested_user', User::whereId(auth()->user()->owner_id)->first() );
//            $view->with('workers', User::grades()->get());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
