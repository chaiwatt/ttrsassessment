<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Model\SocialAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user) { 
        if($user->user_type_id == 1){
            return redirect()->route('dashboard.admin'); 
        }else if($user->user_type_id == 2){
            return redirect()->route('dashboard.expert'); 
        }else if($user->user_type_id == 3){
            // if(Empty($user->linetoken)){
            //     return redirect()->route('line');
            // }else{
            //     return redirect()->route('dashboard.company'); 
            // }
            if($user->verify_type == 1){
                return redirect()->route('dashboard.company'); 
            }
        }
    }

    public function Redirect($provider)
    {
       return Socialite::driver($provider)->redirect();
    }
    public function Callback($provider)
    {
       $providerUser = Socialite::driver($provider)->user();
       $user = $this->createOrGetUser($provider, $providerUser);
       auth()->login($user);
       return redirect()->route('dashboard.company');
    }

    public function createOrGetUser($provider, $providerUser)
    {
        $user = User::where('email',$providerUser->getEmail())->first();
        if (Empty($user)) {
            $user = new User();
            $user->user_type_id = 3;
            $user->name = $providerUser->getName();
            $user->email = $providerUser->getEmail();
            $user->password = Hash::make('11111111');
            $user->email_verified_at = Carbon::now()->toDateString();
            $user->save();
        }
        return $user;
    }
}
