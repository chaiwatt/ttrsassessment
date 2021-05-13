<?php

namespace App\Http\Controllers;

use App\Model\HeaderText;
use Illuminate\Http\Request;
use App\Http\Requests\HomePageBannerRequest;

class SettingAdminWebsiteHomepageBannerController extends Controller
{
    public function Edit(){
        $headertext = HeaderText::first();
        return view('setting.admin.website.homepage.banner.edit')->withHeadertext($headertext);

        // return view('setting.admin.website.layout.index')->withLayoutstyles($layoutstyles)
        // ->withWebsitelayouts($websitelayouts)
        // ->withGeneralinfo($generalinfo);
    }
    public function EditSave(HomePageBannerRequest $request){
        $filelocation = HeaderText::first()->imgbanner;
        $file = $request->file('picture');
        if(!Empty($file)){
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/banner" , $new_name);
            $filelocation = "storage/uploads/banner/".$new_name;
        }

        HeaderText::first()->update([
            'titleth' => $request->titleth,
            'titleeng' => $request->titleeng,
            'detailth' => $request->detailth,
            'detaileng' => $request->detaileng,
            'imgbanner' => $filelocation,
            'youtube' => $request->youtube
        ]);

        return redirect()->route('setting.admin.website.homepage.banner')->withSuccess('แก้ไขสำเร็จ');
    }
}
