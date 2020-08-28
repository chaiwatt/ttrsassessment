<?php

namespace App\Http\Controllers;
use App\Model\SubPillarIndex;
use App\Model\Pillar;
use App\Model\SubPillar;
use Illuminate\Http\Request;

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
        $subpillarindex = new SubPillarIndex();
        $subpillarindex->sub_pillar_id = $request->subpillar;
        $subpillarindex->name = $request->subpillarindex;
        $subpillarindex->save();
        return redirect()->route('setting.admin.assessment.subpillarindex')->withSuccess('เพิ่มรายการ subpillarindex สำเร็จ');
    }
    public function Edit($id){
        // $pillars = Pillar::get();
        
        // $subpillarindex = SubPillarIndex::find($id);
        // $subpillars = SubPillar::where('pillar_id',$subpillarindex->sub_pillar_id);
        // return view('setting.admin.assessment.subpillarindex.edit')->withPillars($pillars)
        //                                                         ->withSubpillars($subpillars)
        //                                                         ->withSubpillarindex($subpillarindex);
    }
    public function GetSubPillar(Request $request){
        $subpillars = SubPillar::where('pillar_id',$request->pillar)->get();
        return response()->json($subpillars);
    }
}
