<?php

namespace App\Http\Controllers;

use App\HomePageSection;
use Illuminate\Http\Request;

class SettingAdminWebsiteHomepageLayoutController extends Controller
{
    public function Index(){
        $homepagesections = HomePageSection::orderBy('id','asc')->get();

        return view('setting.admin.website.homepage.layout.index')->withHomepagesections($homepagesections);
    }

    public function Save(Request $request){
        foreach ($request->orderlist as $key => $order) {
            HomePageSection::find($order)->update([
                'order_list' => $key+1
            ]);
        }
        return redirect()->back()->withSuccess('แก้ไขลำดับ Layout สำเร็จ');
    }
}
