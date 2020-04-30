<?php

namespace App\Http\Controllers;

use App\Model\PageStatus;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePageStatusRequest;

class SettingWebsitePageStatusController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    public function Index(){
        $pagestatuses = PageStatus::get();
        return view('setting.website.pagestatus.index')->withPagestatuses($pagestatuses);
    }
    public function Create(){
        return view('setting.website.pagestatus.create');
    }
    public function CreateSave(CreatePageStatusRequest $request){
        $pagestatus = new PageStatus();
        $pagestatus->name = $request->pagestatus;
        $pagestatus->save();
        return redirect()->route('setting.website.pagestatus')->withSuccess('เพิ่มสถานะการแสดงเพจสำเร็จ');
    }
    public function Edit($id){
        $pagestatus  = PageStatus::find($id);
        return view('setting.website.pagestatus.edit')->withPagestatus($pagestatus);
    }
    public function EditSave(CreatePageStatusRequest $request,$id){
        $pagestatus = PageStatus::find($id)->update([
            'name' => $request->pagestatus
        ]);
        return redirect()->route('setting.website.pagestatus')->withSuccess('แก้ไขสถานะการแสดงเพจสำเร็จ');
    }
    public function Delete($id){
        PageStatus::find($id)->delete();
        return redirect()->route('setting.website.pagestatus')->withSuccess('ลบสถานะการแสดงเพจสำเร็จ');
    }
}
