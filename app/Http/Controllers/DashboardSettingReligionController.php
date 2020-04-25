<?php

namespace App\Http\Controllers;

use App\Model\Religion;
use Illuminate\Http\Request;
use App\Http\Requests\CreateReligionRequest;

class DashboardSettingReligionController extends Controller
{
    public function Index(){
        $religions = Religion::get();
        return view('dashboard.setting.religion.index')->withReligions($religions);
    }
    public function Create(){
        return view('dashboard.setting.religion.create');
    }
    public function CreateSave(CreateReligionRequest $request){
        $religion = new Religion();
        $religion->name = $request->religion;
        $religion->save();
        return redirect()->route('dashboard.setting.religion')->withSuccess('เพิ่มสำเร็จ');
    }
    public function Edit($id){
        $religion = Religion::find($id);
        return view('dashboard.setting.religion.edit')->withReligion($religion);
    }
    public function EditSave(CreateReligionRequest $request,$id){
        $religion = Religion::find($id)->update([
            'name' => $request->religion
        ]);
        return redirect()->route('dashboard.setting.religion')->withSuccess('แก้ไขศาสนาสำเร็จ');
    }


}
