<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if ((auth()->user()->id_rol_user) == 1 ){
            return $next($request);
        }else{
            return redirect('login');
        }
    }
}
