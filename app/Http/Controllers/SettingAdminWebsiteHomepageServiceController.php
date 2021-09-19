<?php

namespace App\Http\Controllers;

use App\Model\Page;
use App\Model\WebPage;
use App\HomePageSection;
use App\Model\CardColor;
use Illuminate\Http\Request;
use App\Model\HomepageService;
use App\Model\HomePageServiceUrl;
use App\Http\Requests\EditHomePageserviceRequest;
use App\Http\Requests\CreateHomePageserviceRequest;
use App\Http\Requests\HomePageServiceCreateRequest;

class SettingAdminWebsiteHomepageServiceController extends Controller
{
    public function Index(){
        $pages = WebPage::get();
        // return $pages;
        $homepageserviceurl = HomePageServiceUrl::first();
        $homepageservices = HomepageService::get();
        $homepagesection = HomePageSection::where('order_list',1)->first();
       return view('setting.admin.website.homepage.service.index')->withHomepageservices($homepageservices)
                                                                ->withHomepagesection($homepagesection)
                                                                ->withHomepageserviceurl($homepageserviceurl)
                                                                ->withPages($pages);
    }

    public function Create(){
        $cardcolors = CardColor::get();
       return view('setting.admin.website.homepage.service.create')->withCardcolors($cardcolors);
    }

    public function CreateSave(HomePageServiceCreateRequest $request){
        $filelocation_iconnormal = null;
        $file = $request->file('iconnormal');
        if(!Empty($file)){
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/service" , $new_name);
            $filelocation_iconnormal = "storage/uploads/service/".$new_name;
        }

        $filelocation_iconhover = null;
        $file = $request->file('iconhover');
        if(!Empty($file)){
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/service" , $new_name);
            $filelocation_iconhover = "storage/uploads/service/".$new_name;
        }
        $homepageservice = new HomepageService();
        $homepageservice->titlethai = $request->titlethai;
        $homepageservice->titleeng = $request->titleeng;
        $homepageservice->descriptionthai = $request->descriptionthai;
        $homepageservice->descriptioneng = $request->descriptioneng;
        $homepageservice->iconnormal = $filelocation_iconnormal;
        $homepageservice->iconhover = $filelocation_iconhover;
        $homepageservice->cardcolor_id = $request->cardcolor;
        // $homepageservice->link = $request->link;
        $homepageservice->color = $request->hexcolor;
        $homepageservice->colortype = $request->colortypeinp;
        $homepageservice->save();

        return redirect()->route('setting.admin.website.homepage.service')->withSuccess('เพิ่มรายการสำเร็จ');
    }

    public function Edit($id){
        $pages = WebPage::get();
        $cardcolors = CardColor::get();
        $homepageservice = HomepageService::find($id);
       return view('setting.admin.website.homepage.service.edit')->withCardcolors($cardcolors)->withHomepageservice($homepageservice)->withPages($pages);
    }

    public function EditSave(Request $request,$id){
        
        $filelocation_iconnormal = HomepageService::find($id)->iconnormal;
        $file = $request->file('iconnormal');
        if(!Empty($file)){
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/service" , $new_name);
            $filelocation_iconnormal = "storage/uploads/service/".$new_name;
        }

        $filelocation_iconhover = HomepageService::find($id)->iconhover;
        $file = $request->file('iconhover');
        if(!Empty($file)){
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/service" , $new_name);
            $filelocation_iconhover = "storage/uploads/service/".$new_name;
        }

        $homepageservice = HomepageService::find($id)->update([
            'titlethai' => $request->titlethai,
            'titleeng' => $request->titleeng,
            'descriptionthai' => $request->descriptionthai,
            'descriptioneng' => $request->descriptioneng,
            'iconnormal' => $filelocation_iconnormal,
            'iconhover' => $filelocation_iconhover,
            'cardcolor_id' => $request->cardcolor,
            // 'link' => $request->link,
            'color' => $request->hexcolor,
            'colortype' => $request->colortypeinp
        ]);

       return redirect()->route('setting.admin.website.homepage.service')->withSuccess('แก้ไขรายการสำเร็จ');
    }
    
    public function EditSaveStatus(Request $request){
        $link = $request->link;
        if($request->linktype == 1){
            $link = url('').'/webpage/'.WebPage::find($request->page)->slug;
        }

        HomePageSection::where('order_list',1)->first()->update([
            'show' => $request->status
        ]);
        $check = HomePageServiceUrl::first();
        if(Empty($check)){
            $new = new HomePageServiceUrl();
            $new->url = $link;
            $new->url_type = $request->linktype;
            $new->save();
        }else{
            HomePageServiceUrl::first()->update([
                'url' => $link,
                'url_type' => $request->linktype
            ]);
        }

        return redirect()->route('setting.admin.website.homepage.service')->withSuccess('แก้ไขรายการสำเร็จ');
    }

    public function Delete($id){
        $homepageservice = HomepageService::find($id);
        if(!Empty($homepageservice->iconnormal)){
            @unlink($homepageservice->iconnormal);
        }
        if(!Empty($homepageservice->iconhover)){
            @unlink($homepageservice->iconhover);
        }
        $homepageservice->delete();
        return redirect()->route('setting.admin.website.homepage.service')->withSuccess('ลบรายการสำเร็จ');
    }
}
