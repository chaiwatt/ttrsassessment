<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            if(Empty($user->linetoken)){
                return redirect()->route('line');
            }else{
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
       dd($providerUser);
       $user = $this->createOrGetUser($provider, $providerUser);
       auth()->login($user);
       return redirect()->to('/home');
    }

    public function createOrGetUser($provider, $providerUser)
    {
        $account = SocialAccount::whereProvider($provider)
                                ->whereProviderUserId($providerUser->getId())
                                ->first();
        if(!Empty($account)){
            return $account->user;
        }else{
            $user = User::whereEmail($providerUser->getEmail())->first();
          
            if (!Empty($user)) {
                $user = User::create([
                  'email' => $providerUser->getEmail(),
                  'name' => $providerUser->getName(),
                  'password' => md5(rand(1,10000)),
                ]);
            }
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider
            ]);
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }



}
