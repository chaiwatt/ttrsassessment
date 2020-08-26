<?php

namespace App\Http\Controllers;

use App\Model\Pillar;
use Illuminate\Http\Request;

class SettingAdminAssessmentPillarController extends Controller
{
    public function Index(){
        $pillars = Pillar::get();
        return view('setting.admin.assessment.pillar.index')->withPillars($pillars);
    }
    public function Create(){
        $pillars = Pillar::get();
        return view('setting.admin.assessment.pillar.create')->withPillars($pillars);
    }
    public function CreateSave(Request $request){
        $pillar = new Pillar();
        $pillar->name = $request->name;
        $pillar->percent = $request->percent;
        $pillar->save();
        return redirect()->route('setting.admin.assessment.pillar')->withSuccess('เพิ่มรายการ Pillar สำเร็จ');
    }
    public function Edit($id){
        $pillar = Pillar::find($id);
        return view('setting.admin.assessment.pillar.edit')->withPillar($pillar);
    }
    public function EditSave(Request $request,$id){
        $pillar = Pillar::find($id)->update([
            'name' => $request->name,
            'percent' => $request->percent
        ]);
        return redirect()->route('setting.admin.assessment.pillar')->withSuccess('แก้ไขรายการ Pillar สำเร็จ');
    }
    public function Delete($id){
        $pillar = Pillar::find($id)->delete();
        return redirect()->route('setting.admin.assessment.pillar')->withSuccess('ลบรายการ Pillar สำเร็จ');
    }
}
