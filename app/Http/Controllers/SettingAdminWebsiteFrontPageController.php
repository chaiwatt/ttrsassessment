<?php

namespace App\Http\Controllers;

use App\Model\FrontPage;
use Illuminate\Http\Request;
use App\Http\Requests\SaveFrontPageRequest;

class SettingAdminWebsiteFrontPageController extends Controller
{
    public function Index(){
        $frontpage = FrontPage::first();
        return view('setting.admin.website.frontpage.index')->withFrontpage($frontpage);
    }

    public function Save(SaveFrontPageRequest $request){
        $frontpage = FrontPage::first();
        $frontimg = $request->frontimg;
        $btnimg = $request->btnimg;
        $frontimglocation = $frontpage->file;
        $btnimglocation = $frontpage->entersitebtn;
        if(!Empty($frontimg)){
            @unlink($frontpage->file);
            $new_name = str_random(10).".".$frontimg->getClientOriginalExtension();
            $frontimg->move("storage/uploads/landing/frontpage" , $new_name);
            $frontimglocation = "storage/uploads/landing/frontpage/".$new_name;
        }
        // if(!Empty($btnimg)){
        //     @unlink($frontpage->entersitebtn);
        //     $new_name = str_random(10).".".$frontimg->getClientOriginalExtension();
        //     $btnimg->move("storage/uploads/landing/frontpage" , $new_name);
        //     $btnimglocation = "storage/uploads/landing/frontpage/".$new_name;
        // }
        $frontpage->update([
            'file' => $frontimglocation,
            'entersitebtn' => $btnimglocation,
            'bgcolor' => $request->bgcolor,
            'percentimg' => $request->percent,
        ]);
        return redirect()->back()->withSuccess('แก้ไขข้อมูลสำเร็จ');
    }
}
