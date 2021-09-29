<?php

namespace App\Http\Controllers;

use App\Model\Religion;
use Illuminate\Http\Request;
use App\Http\Requests\CreateReligionRequest;

class SettingAdminDashboardReligionController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:0,4,5,6,7,8,9,10'); 
    }
    
    public function Index(){
        $religions = Religion::get();
        return view('setting.admin.dashboard.religion.index')->withReligions($religions);
    }
    public function Create(){
        return view('setting.admin.dashboard.religion.create');
    }
    public function CreateSave(CreateReligionRequest $request){
        $religion = new Religion();
        $religion->name = $request->religion;
        $religion->save();
        return redirect()->route('setting.admin.dashboard.religion')->withSuccess('เพิ่มสำเร็จ');
    }
    public function Edit($id){
        $religion = Religion::find($id);
        return view('setting.admin.dashboard.religion.edit')->withReligion($religion);
    }
    public function EditSave(CreateReligionRequest $request,$id){
        $religion = Religion::find($id)->update([
            'name' => $request->religion
        ]);
        return redirect()->route('setting.admin.dashboard.religion')->withSuccess('แก้ไขศาสนาสำเร็จ');
    }
    public function Delete($id){
        Religion::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.religion')->withSuccess('ลบรายการสำเร็จ');
    }
}
