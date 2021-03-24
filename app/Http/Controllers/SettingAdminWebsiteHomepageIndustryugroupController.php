<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HomepageIndustryGroupText;

class SettingAdminWebsiteHomepageIndustryugroupController extends Controller
{
    public function Edit(){
        $homepageindustrygroup = HomepageIndustryGroupText::first();
        return view('setting.admin.website.homepage.industryugroup.edit')->withHomepageindustrygroup($homepageindustrygroup);
    }
}
