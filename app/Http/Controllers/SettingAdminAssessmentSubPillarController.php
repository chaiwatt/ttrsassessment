<?php

namespace App\Http\Controllers;

use App\Model\Pillar;
use App\Model\SubPillar;
use Illuminate\Http\Request;
use App\Model\CriteriaTransaction;

class SettingAdminAssessmentSubPillarController extends Controller
{
    public function Index(){
        $subpillars = SubPillar::get();
        return view('setting.admin.assessment.subpillar.index')->withSubpillars($subpillars);
    }
    public function Create(){
        $pillars = Pillar::get();
        return view('setting.admin.assessment.subpillar.create')->withPillars($pillars);
    }
    public function CreateSave(Request $request){
        $subpillar = new SubPillar();
        $subpillar->pillar_id = $request->pillarid;
        $subpillar->name = $request->subpillar;
        $subpillar->save();
        return redirect()->route('setting.admin.assessment.subpillar')->withSuccess('เพิ่มรายการ Sub Pillar สำเร็จ');
    }
    public function Edit($id){
        $pillars = Pillar::get();
        $subpillar = SubPillar::find($id);
        return view('setting.admin.assessment.subpillar.edit')->withSubpillar($subpillar)
                                                              ->withPillars($pillars);
    }
    public function EditSave(Request $request,$id){
        $check = CriteriaTransaction::where('pillar_id',$id)->first();
        if(!empty($check)){
            return redirect()->route('setting.admin.assessment.subpillar')->withError('ผิดพลาดมีการใช้ Pillar นี้แล้ว');
        }
        $pillars = Pillar::get();
        $subpillar = SubPillar::find($id)->update([
            'pillar_id' =>$request->pillarid,
            'name' =>$request->subpillar
        ]);
        return redirect()->route('setting.admin.assessment.subpillar')->withSubpillar($subpillar)
                                                                      ->withPillars($pillars)
                                                                      ->withSuccess('แก้ไข Sub Pillar สำเร็จ');
    }
    public function Delete($id){
        $check = CriteriaTransaction::where('pillar_id',$id)->first();
        if(!empty($check)){
            return redirect()->route('setting.admin.assessment.subpillar')->withError('ผิดพลาดมีการใช้ Pillar นี้แล้ว');
        }
        $subpillar = SubPillar::find($id)->delete();
        return redirect()->route('setting.admin.assessment.subpillar')->withSubpillar($subpillar)
                                                                      ->withSuccess('ลบ Sub Pillar สำเร็จ');
    }
}
