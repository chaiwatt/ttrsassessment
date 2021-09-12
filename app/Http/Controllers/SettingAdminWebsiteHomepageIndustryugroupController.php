<?php

namespace App\Http\Controllers;

use App\Model\WebPage;
use App\HomePageSection;
use Illuminate\Http\Request;
use App\Model\HomePageIndustryUrl;
use App\Model\HomepageIndustryGroupText;
use App\Http\Requests\HomePageIndustryRequest;

class SettingAdminWebsiteHomepageIndustryugroupController extends Controller
{
    public function Edit(){
        $homepageindustryurl = HomePageIndustryUrl::first();
        $pages = WebPage::get();
        $homepagesection = HomePageSection::where('order_list',2)->first();
        // return $homepagesection;
        $homepageindustrygroup = HomepageIndustryGroupText::first();
        return view('setting.admin.website.homepage.industryugroup.edit')->withHomepageindustrygroup($homepageindustrygroup)
                                                                    ->withHomepagesection($homepagesection)
                                                                    ->withHomepageindustryurl($homepageindustryurl)
                                                                    ->withPages($pages);
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


        $link = $request->link;
        if($request->linktype == 1){
            $link = url('').'/webpage/'.WebPage::find($request->page)->slug;
        }
        $check = HomePageIndustryUrl::first();
        if(Empty($check)){
            $new = new HomePageIndustryUrl();
            $new->url = $link;
            $new->url_type = $request->linktype;
            $new->save();
        }else{
            HomePageIndustryUrl::first()->update([
                'url' => $link,
                'url_type' => $request->linktype
            ]);
        }

        HomePageSection::where('order_list',2)->first()->update([
            'show' => $request->status
        ]);

        return redirect()->route('setting.admin.website.homepage.industryugroup')->withSuccess('แก้ไขสำเร็จ');
    }
}
