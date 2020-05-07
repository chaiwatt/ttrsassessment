<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\UserPosition;
use App\Model\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingProfileController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1,2,3'); 
    }
    public function Edit($userid){
        $auth = Auth::user();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$auth->province_id)->get();
        $tambols = Tambol::where('amphur_id',$auth->amphur_id)->get();
        $prefixes = Prefix::get();
        $user = User::find($userid);
        $userpositions = UserPosition::get();
        return view('setting.profile.edit')->withUser($user)
                                        ->withPrefixes($prefixes)
                                        ->withProvinces($provinces)
                                        ->withAmphurs($amphurs)
                                        ->withTambols($tambols)
                                        ->withUserpositions($userpositions);
    }
}
