<?php

namespace App\Http\Controllers;

use App\Model\EvType;
use Illuminate\Http\Request;

class SettingAdminAssessmentEvPortionController extends Controller
{
    public function Index(){
        $evtypes = EvType::get();
        return view('setting.admin.assessment.evportion.index')->withEvtypes($evtypes);
    }
    public function Edit($id){
        $evtype = EvType::find($id);
        return view('setting.admin.assessment.evportion.edit')->withEvtype($evtype);
    }
    public function EditSave(Request $request,$id){
        $evtype = EvType::find($id)->update([
            'name' => $request->name,
            'percent' => $request->percent
        ]);
        return redirect()->route('setting.admin.assessment.evportion')->withSuccess('แก้ไขสำเร็จ');
    }
}
