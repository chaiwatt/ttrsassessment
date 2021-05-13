<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HomepageIndustryGroupText;
use App\Http\Requests\HomePageIndustryRequest;

class SettingAdminWebsiteHomepageIndustryugroupController extends Controller
{
    public function Edit(){
        $homepageindustrygroup = HomepageIndustryGroupText::first();
        return view('setting.admin.website.homepage.industryugroup.edit')->withHomepageindustrygroup($homepageindustrygroup);
    }
    public function EditSave(HomePageIndustryRequest $request){
        $filelocation = HomepageIndustryGroupText::first()->picture;
        $file = $request->file('picture');
        if(!Empty($file)){
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/banner" , $new_name);
            $filelocation = "storage/uploads/banner/".$new_name;
        }

        HomepageIndustryGroupText::first()->update([
            'titleth' => $request->titleth,
            'titleeng' => $request->titleeng,
            'subtitleth' => $request->subtitleth,
            'subtitleeng' => $request->subtitleeng,
            'picture' => $filelocation,
            'url' => $request->url
        ]);

        return redirect()->route('setting.admin.website.homepage.industryugroup')->withSuccess('แก้ไขสำเร็จ');
    }
}
