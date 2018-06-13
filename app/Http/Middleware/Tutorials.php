<?php

namespace App\Http\Middleware;

use Closure;

class Tutorials
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {





            $response = $next($request);

            if(auth()->check()) {

//                Nastavenie údajov, platí pre každého
                if(auth()->user()->haveTutorial('setup-profile'))
                {
                    return redirect('/add/missing/data');
                }

            } else {

                return $response;

            }



        if(auth()->user()->hasAnyRoles([1, 2]) ) {

            if(auth()->user()->haveTutorial('setup-profile'))
            {
                return redirect('/add/missing/data');
            }

            if($user = auth()->user()->haveTutorial('create-class'))
            {
                return redirect('/add/create/grade');
            }

            if(auth()->user()->haveTutorial('create-student'))
            {
                return redirect('/add/create/student');
            }

            if(auth()->user()->haveTutorial('create-parent'))
            {
                return redirect('/add/create/parent');
            }

            return $response;
        }

        return $response;
    }
}
