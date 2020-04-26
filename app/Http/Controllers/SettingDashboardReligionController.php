<?php

namespace App\Http\Controllers;

use App\Model\Religion;
use Illuminate\Http\Request;

class SettingDashboardReligionController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    
    public function Index(){
        $religions = Religion::get();
        return view('setting.dashboard.religion.index')->withReligions($religions);
    }
    public function Create(){
        return view('setting.dashboard.religion.create');
    }
    public function CreateSave(CreateReligionRequest $request){
        $religion = new Religion();
        $religion->name = $request->religion;
        $religion->save();
        return redirect()->route('setting.dashboard.religion')->withSuccess('เพิ่มสำเร็จ');
    }
    public function Edit($id){
        $religion = Religion::find($id);
        return view('setting.dashboard.religion.edit')->withReligion($religion);
    }
    public function EditSave(CreateReligionRequest $request,$id){
        $religion = Religion::find($id)->update([
            'name' => $request->religion
        ]);
        return redirect()->route('setting.dashboard.religion')->withSuccess('แก้ไขศาสนาสำเร็จ');
    }
}
