<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if($request->user() && in_array($request->user()->user_type_id, $roles) ) 
        { 
            return $next($request); 
        } 
        Session::flush(); 
        return redirect('login');
    }
}
