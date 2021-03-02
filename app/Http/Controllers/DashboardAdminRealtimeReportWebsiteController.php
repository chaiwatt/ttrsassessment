<?php

namespace App\Http\Controllers;

use App\Model\Page;
use App\Model\DirectMenu;
use App\Model\ContactInfo;
use Illuminate\Http\Request;

class DashboardAdminRealtimeReportWebsiteController extends Controller
{
    public function Visit(){
        $directmenus = DirectMenu::get();
        $pages = Page::get();
        return view('dashboard.admin.realtimereport.website.index')->withPages($pages)
                                                            ->withDirectmenus($directmenus);
    }
    public function Contact(){
        $contactinfos = ContactInfo::paginate(10);
        return view('dashboard.admin.realtimereport.website.contactinfo')->withContactinfos($contactinfos);
    }
    public function view($id){
        $contactinfo = ContactInfo::find($id);
        return view('dashboard.admin.realtimereport.website.view')->withContactinfo($contactinfo);
    }
    public function update($id){
        ContactInfo::find($id)->update([
            'status' => 2
        ]);
        return redirect()->route('dashboard.admin.realtimereport.website.contact')->withSuccess('บันทึกว่าอ่านแล้ว');
    }
    public function delete($id){
        ContactInfo::find($id)->delete();
        return redirect()->route('dashboard.admin.realtimereport.website.contact')->withSuccess('ลบรายการแล้ว');
    }
}
