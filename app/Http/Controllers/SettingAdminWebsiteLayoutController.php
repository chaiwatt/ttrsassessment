<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingAdminWebsiteLayoutController extends Controller
{
    public function Index(){
        return view('setting.admin.website.layout.index');
    }
}
