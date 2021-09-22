<?php

namespace App\Http\Controllers;

use App\HomePageSection;
use Illuminate\Http\Request;
use App\Helper\CreateDirectory;

class SettingAdminWebsiteHomepageCustomSectionController extends Controller
{
    public function Edit($id){
        $customsection = HomePageSection::find($id);
        $homepagesections = HomePageSection::get();
        return view('setting.admin.website.homepage.customsection.edit')->withCustomsection($customsection)->withHomepagesections($homepagesections);
    }

    public function EditSave(Request $request,$id){
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$request->content);
        CreateDirectory::CreateDirectory(public_path("storage/uploads/page/images/"));
        $images = $dom->getelementsbytagname('img');
        $imgarray = array();
        foreach($images as $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)= explode(',', $data);
            $data = base64_decode($data);
            $image_name= str_random(10).'.png';
            $imgarray[] = URL('')."/storage/uploads/page/images/".$image_name;
            $path = public_path() .'/storage/uploads/page/images/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', URL('')."/storage/uploads/page/images/".$image_name);
        }
        $content = $dom->savehtml();

        HomePageSection::find($id)->update([
            'content' => $content,
            'bg' => $request->bgcss,
            'show' => $request->status
        ]);
        return redirect()->back()->withSuccess('เพิ่มข้อมูล Section สำเร็จ');
    }
}
