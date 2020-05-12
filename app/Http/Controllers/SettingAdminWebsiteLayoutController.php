<?php

namespace App\Http\Controllers;

use App\Model\LayoutStyle;
use Illuminate\Http\Request;

class SettingAdminWebsiteLayoutController extends Controller
{
    public function Index(){
        $layoutstyles = LayoutStyle::get();
        return view('setting.admin.website.layout.index')->withLayoutstyles($layoutstyles);
    }
}
