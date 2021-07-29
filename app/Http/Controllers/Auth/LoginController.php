<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\UserLog;
use App\Model\GeneralInfo;
use App\Model\BusinessPlan;
use App\Model\SocialAccount;
use Illuminate\Http\Request;
use App\Helper\CreateCompany;
use App\Helper\CreateUserLog;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    // protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user) { 
        $generalinfo = GeneralInfo::first();
        CreateUserLog::createlog('เข้าสู่ระบบ');
        if($user->user_status_id == 2){
            Auth::logout();
            Session::flush();
            return redirect()->route('login')->withError('บัญชีของคุณถูกระงับการใช้งาน');
        }
         $baseurl =URL::to('/');
         $intendurl = redirect()->intended()->getTargetUrl();
         if(strcmp($intendurl,$baseurl) == 0){
            if($generalinfo->verify_expert_status_id == 2){
                if(($user->user_type_id == 3 || $user->user_type_id == 4) && $user->verify_expert == 1){
                    Auth::logout();
                    Session::flush();
                    return redirect()->route('login')->withError('บัญชียังไม่ได้เปิดใช้งาน กรุณาติดต่อ Admin');
                }
            }
            if($user->user_type_id >= 4){
                return redirect()->route('dashboard.admin.report'); 
            }else if($user->user_type_id == 3){
                return redirect()->route('dashboard.expert.report'); 
            }else if($user->user_type_id <= 2){
                $businessplans = BusinessPlan::where('company_id',Company::where('user_id',$user->id)->first()->id)->get();
                return redirect()->route('dashboard.company.report')->withBusinessplans($businessplans); 
            }
         }else{
            return redirect($intendurl);
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
            $user->user_type_id = 2;
            $user->name = $providerUser->getName();
            $user->email = $providerUser->getEmail();
            $user->password = Hash::make('11111111');
            $user->email_verified_at = Carbon::now()->toDateString();
            $user->save();
            CreateCompany::createCompany($user,'','',5);
        }
        return $user;
    }
    public function logout(Request $request)
    {
        CreateUserLog::createlog('ออกจากระบบ');
        Auth::logout();
        Session::flush();
        return redirect()->route('landing2.index');
    }
}
