<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SettingProfileController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1,2,3'); 
    }
    public function Edit($userid){
        $user = User::find($userid);
        return view('setting.profile.edit')->withUser($user);
    }
}
