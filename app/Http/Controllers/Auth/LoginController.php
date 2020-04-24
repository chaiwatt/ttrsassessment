<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    protected function authenticated(Request $request, $user) { 
        if($user->user_type_id == 1){
            return redirect()->route('dashboard.admin'); 
        }else if($user->user_type_id == 2){
            return redirect()->route('dashboard.expert'); 
        }else if($user->user_type_id == 3){
            if(Empty($user->linetoken)){
                return redirect()->route('line');
            }else{
                return redirect()->route('dashboard.company'); 
            }
            
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
