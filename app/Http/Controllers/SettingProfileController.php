<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SettingProfileController extends Controller
{
    public function Edit($userid){
        $user = User::find($userid);
        return view('setting.profile.edit')->withUser($user);
    }
}
