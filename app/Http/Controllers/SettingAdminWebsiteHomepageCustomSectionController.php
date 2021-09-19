<?php

namespace App\Http\Controllers;

use App\HomePageSection;
use Illuminate\Http\Request;

class SettingAdminWebsiteHomepageCustomSectionController extends Controller
{
    public function Edit($id){
        $customsection = HomePageSection::find($id);
        $homepagesections = HomePageSection::get();
        // return $homepagesections; 
        return view('setting.admin.website.homepage.customsection.edit')->withCustomsection($customsection)->withHomepagesections($homepagesections);
    }

    public function EditSave(Request $request,$id){
        // foreach ($request->orderlist as $key => $order) {

        //     HomePageSection::find($key+1)->update([
        //         'order_list' => $order
        //     ]);
        // }

        // foreach ($request->orderlist as $key => $order) {
        //     HomePageSection::find($order)->update([
        //         'order_list' => $key+1
        //     ]);
        // }

        HomePageSection::find($id)->update([
            'content' => $request->content,
            'bg' => $request->bgcss,
            'show' => $request->status
        ]);
        return redirect()->back()->withSuccess('เพิ่มข้อมูล Section สำเร็จ');
    }
}
