<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect(RouteServiceProvider::HOME);
            $user = Auth::user();
            if($user->user_type_id >= 4){
                return redirect()->route('dashboard.admin'); 
            }else if($user->user_type_id == 2){
                return redirect()->route('dashboard.expert'); 
            }else if($user->user_type_id <= 2){
                if($user->verify_type == 1){
                    return redirect()->route('dashboard.company'); 
                }
            }
            // return redirect()->intended();
        }

        return $next($request);
    }
}


