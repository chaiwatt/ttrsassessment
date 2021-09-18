<?php

namespace App\Http\Controllers;

use App\Model\WebPage;
use App\HomePageSection;
use Illuminate\Http\Request;
use App\Model\HomepagePillar;
use App\Model\HomePagePillarUrl;
use App\Model\HomepagePillarSection;
use App\Http\Requests\HomePagePillarRequest;
use App\Http\Requests\EditHomePagePillarRequest;

class SettingAdminWebsiteHomepagePillarController extends Controller
{
    public function Edit(){
        $homepagepillarurl = HomePagePillarUrl::first();
        $pages = WebPage::get();
        $homepagesection = HomePageSection::where('order_list',3)->first();
        $homepagepillar = HomepagePillarSection::first();
        return view('setting.admin.website.homepage.pillar.edit')->withHomepagepillar($homepagepillar)->withHomepagepillarurl($homepagepillarurl)
        ->withHomepagesection($homepagesection)
        ->withPages($pages);
    }

    public function EditSave(HomePagePillarRequest $request){
        // return $request->linktype;
        HomepagePillarSection::first()->update([
            'textth1' =>  $request->textth1,
            'texteng1' =>  $request->texteng1,
            'textth2' =>  $request->textth2,
            'texteng2' =>  $request->texteng2,
            'pillartitleth1' =>  $request->pillartitleth1,
            'pillartitleeng1' =>  $request->pillartitleeng1,
            'pillartitleth2' =>  $request->pillartitleth2,
            'pillartitleeng2' =>  $request->pillartitleeng2,
            'pillartitleth3' =>  $request->pillartitleth3,
            'pillartitleeng3' =>  $request->pillartitleeng3,
            'pillartitleth4' =>  $request->pillartitleth4,
            'pillartitleeng4' =>  $request->pillartitleeng4,
            'pillardescth1' =>  $request->pillardescth1,
            'pillardesceng1' =>  $request->pillardesceng1,
            'pillardescth2' =>  $request->pillardescth2,
            'pillardesceng2' =>  $request->pillardesceng2,
            'pillardescth3' =>  $request->pillardescth3,
            'pillardesceng3' =>  $request->pillardesceng3,
            'pillardescth4' =>  $request->pillardescth4,
            'pillardesceng4' =>  $request->pillardesceng4,
            'color1' =>  $request->color1,
            'color2' =>  $request->color2,
            'color3' =>  $request->color3,
            'color4' =>  $request->color4
        ]);

        $link = $request->link;
        if($request->linktype == 1){
            $link = url('').'/webpage/'.WebPage::find($request->page)->slug;
        }
        $check = HomePagePillarUrl::first();
        if(Empty($check)){
            $new = new HomePagePillarUrl();
            $new->url = $link;
            $new->url_type = $request->linktype;
            $new->save();
        }else{
            HomePagePillarUrl::first()->update([
                'url' => $link,
                'url_type' => $request->linktype
            ]);
        }

        HomePageSection::where('order_list',3)->first()->update([
            'show' => $request->status
        ]);
        return redirect()->route('setting.admin.website.homepage.pillar')->withSuccess('แก้ไขสำเร็จ');
    }
    
}
