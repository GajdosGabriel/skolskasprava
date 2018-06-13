<?php

namespace App\Http\Middleware;

use Closure;

class Workers
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
        if(auth()->check()) {

            if(auth()->user()->hasAnyRoles([1,2])) {
                return $next($request);
            } else {
                return redirect('/');
            }

        } else {
            return redirect('/');
        }

    }
}
