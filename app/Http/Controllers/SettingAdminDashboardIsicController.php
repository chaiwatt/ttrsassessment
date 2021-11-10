<?php

namespace App\Http\Controllers;

use App\Model\Isic;
use App\Model\Company;
use Illuminate\Http\Request;

class SettingAdminDashboardIsicController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:0,4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $isics = Isic::get();
        return view('setting.admin.dashboard.isic.index')->withIsics($isics);
    }

    public function Create(){
        return view('setting.admin.dashboard.isic.create');
    }
    public function CreateSave(Request $request){
        $isic = new Isic();
        $isic->name = $request->isic;
        $isic->code = $request->code;
        $isic->save();
        return redirect()->route('setting.admin.dashboard.isic')->withSuccess('เพิ่ม ISIC สำเร็จ');
    }

    public function Edit($id){
        $isic = Isic::find($id);
        return view('setting.admin.dashboard.isic.edit')->withIsic($isic);
    }
    public function EditSave(Request $request,$id){
        $check = Company::where('isic_id',$id)->first();
        if(!Empty($check)){
            return redirect()->route('setting.admin.dashboard.isic')->withError('มีการใช้ ISIC นี้แล้ว');
        }
        $isic = Isic::find($id)->update([
            'name' => $request->isic,
            'code' => $request->code
        ]);
        return redirect()->route('setting.admin.dashboard.isic')->withSuccess('แก้ไข ISIC สำเร็จ');
    }

    public function Delete($id){
        $check = Company::where('isic_id',$id)->first();
        if(!Empty($check)){
            return redirect()->route('setting.admin.dashboard.isic')->withError('มีการใช้ ISIC นี้แล้ว');
        }
        Isic::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.isic')->withSuccess('ลบ ISIC สำเร็จ');
    }
}
