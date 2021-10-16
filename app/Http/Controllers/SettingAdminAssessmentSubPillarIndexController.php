<?php

namespace App\Http\Controllers;
use App\Model\Pillar;
use App\Model\SubPillar;
use Illuminate\Http\Request;
use App\Model\SubPillarIndex;
use App\Model\CriteriaTransaction;

class SettingAdminAssessmentSubPillarIndexController extends Controller
{
    public function Index(){
        $subpillarindexes = SubPillarIndex::get();
        return view('setting.admin.assessment.subpillarindex.index')->withSubpillarindexes($subpillarindexes);
    }
    public function Create(){
        $pillars = Pillar::get();
        return view('setting.admin.assessment.subpillarindex.create')->withPillars($pillars);
    }
    public function CreateSave(Request $request){

        if(Empty($request->subpillar) || Empty($request->subpillarindex)){
            return redirect()->back()->withError('กรุณากรอกข้อมูลให้ครบถ้วน');
        }

        $subpillarindex = new SubPillarIndex();
        $subpillarindex->sub_pillar_id = $request->subpillar;
        $subpillarindex->name = $request->subpillarindex;
        $subpillarindex->save();
        return redirect()->route('setting.admin.assessment.subpillarindex')->withSuccess('เพิ่มรายการ subpillarindex สำเร็จ');
    }
    public function Edit($id){
        $subpillarindex = SubPillarIndex::find($id);
        $pillars = Pillar::get(); 
        $_subpillars = SubPillar::find($subpillarindex->sub_pillar_id);
        $subpillars = SubPillar::where('pillar_id',$_subpillars->pillar_id)->get();
        return view('setting.admin.assessment.subpillarindex.edit')->withPillars($pillars)
                                                                ->withSubpillars($subpillars)
                                                                ->withSubpillarindex($subpillarindex);
    }
    public function EditSave(Request $request,$id){
        $check = CriteriaTransaction::where('sub_pillar_index_id',$id)->first();
        if(!empty($check)){
            return redirect()->route('setting.admin.assessment.subpillarindex')->withError('ผิดพลาดมีการใช้ Sub Pillar Index นี้แล้ว');
        }

        SubPillarIndex::find($id)->update([
            'sub_pillar_id' => $request->subpillar,
            'name' => $request->subpillarindex
        ]);
        return redirect()->route('setting.admin.assessment.subpillarindex')->withSuccess('แก้ไขรายการสำเร็จ');
    }
    public function Delete($id){
        $check = CriteriaTransaction::where('sub_pillar_index_id',$id)->first();
        if(!empty($check)){
            return redirect()->route('setting.admin.assessment.subpillarindex')->withError('ผิดพลาดมีการใช้ Sub Pillar Index นี้แล้ว');
        }
        SubPillarIndex::find($id)->delete();
        return redirect()->route('setting.admin.assessment.subpillarindex')->withSuccess('ลบรายการสำเร็จ');
    }
    public function GetSubPillar(Request $request){
        $subpillars = SubPillar::where('pillar_id',$request->pillar)->get();
        return response()->json($subpillars);
    }
    public function GetSubPillarIndex(Request $request){
        $subpillarindexs = SubPillarIndex::where('sub_pillar_id',$request->subpillar)->get();
        return response()->json($subpillarindexs);
    }
}
