<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HomepageService;
use App\Http\Requests\EditHomePageserviceRequest;
use App\Http\Requests\CreateHomePageserviceRequest;

class SettingAdminWebsiteHomepageServiceController extends Controller
{
    public function Index(){
        $homepageservices = HomepageService::get();
        return view('setting.admin.website.homepage.service.index')->withHomepageservices($homepageservices);
    }
    public function Create(){
        return view('setting.admin.website.homepage.service.create');
    }

    public function CreateSave(CreateHomePageserviceRequest $request){
        $filelocation = '';
        $file = $request->file('iconimg');
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/service" , $new_name);
        $filelocation = "storage/uploads/service/".$new_name;
        $homepageservice = new HomepageService();
        $homepageservice->titlethai = $request->titlethai;
        $homepageservice->titleeng = $request->titleeng;
        $homepageservice->descriptionthai = $request->descriptionthai;
        $homepageservice->descriptioneng = $request->descriptioneng;
        $homepageservice->icon = $filelocation;
        $homepageservice->link = $request->link;
        $homepageservice->save();
        return redirect()->route('setting.admin.website.homepage.service')->withSuccess('เพิ่ม Service สำเร็จ');
    }
    public function Edit($id){
        $homepageservice = HomepageService::find($id);
        return view('setting.admin.website.homepage.service.edit')->withHomepageservice($homepageservice);
    }
    public function EditSave(EditHomePageserviceRequest $request,$id){
        $homepageservice = HomepageService::find($id);
        $filelocation = $homepageservice->icon;
        $file = $request->file('iconimg');
        if(!Empty($file)){
            unlink($homepageservice->icon);
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/service" , $new_name);
            $filelocation = "storage/uploads/service/".$new_name;
        }
    
        HomepageService::find($id)->update([
            'titlethai' => $request->titlethai,
            'titleeng' => $request->titleeng,
            'descriptionthai' => $request->descriptionthai,
            'descriptioneng' => $request->descriptioneng,
            'link' => $request->link,
            'icon' => $filelocation
        ]);

        return redirect()->route('setting.admin.website.homepage.service')->withSuccess('แก้ไข Service สำเร็จ');
    }

    public function Delete($id){
        HomepageService::find($id)->delete();
        return redirect()->route('setting.admin.website.homepage.service')->withSuccess('ลบ Service สำเร็จ');
    }
}
