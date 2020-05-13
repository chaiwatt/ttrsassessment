<?php

namespace App\Http\Controllers;

use App\Model\GeneralInfo;
use App\Model\LayoutStyle;
use App\Model\WebsiteLayout;
use Illuminate\Http\Request;

class SettingAdminWebsiteLayoutController extends Controller
{
    public function Index(){
        $layoutstyles = LayoutStyle::get();
        $websitelayouts = WebsiteLayout::get();
        $generalinfo = GeneralInfo::first();
        // return  $websitelayouts ;
        return view('setting.admin.website.layout.index')->withLayoutstyles($layoutstyles)
                                                    ->withWebsitelayouts($websitelayouts)
                                                    ->withGeneralinfo($generalinfo);
    }
}
