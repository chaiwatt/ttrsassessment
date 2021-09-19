<?php

namespace App\Http\Controllers;

use App\Model\ContactInfo;
use Illuminate\Http\Request;

class SettingAdminProjectContactinfoController extends Controller
{
    public function Index(){
        $contactinfos = ContactInfo::get();
   
        return view('setting.admin.system.contactinfo.index')->withContactinfos($contactinfos);
        // return $contactinfos;
    }
}
