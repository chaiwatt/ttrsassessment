<?php

namespace App\Http\Controllers;

use App\Model\Pillar;
use App\Model\Criteria;
use Illuminate\Http\Request;

class SettingAdminAssessmentCriteriaController extends Controller
{
    public function Index(){
        $criterias = Criteria::orderBy('sub_pillar_index_id','asc')->get();
        return view('setting.admin.assessment.criteria.index')->withCriterias($criterias) ;
    }
    public function Create(){
        $criterias = Criteria::get();
        $pillars = Pillar::get();
        return view('setting.admin.assessment.criteria.create')->withPillars($pillars) ;
    }
    public function CreateSave(Request $request){
        $criteria = new Criteria();
        $criteria->sub_pillar_index_id = $request->subpillarindex;
        $criteria->name = $request->criteria;
        $criteria->save();
        return redirect()->route('setting.admin.assessment.criteria')->withSuccess('เพิ่มรายการสำเร็จ');
    }
    public function Edit($id){
        $criteria = Criteria::find($id);
        return view('setting.admin.assessment.criteria.edit')->withCriteria($criteria) ;
    }
    public function EditSave(Request $request,$id){
        $criteria = Criteria::find($id)->update([
            'name' => $request->criteria,
        ]);
        return redirect()->route('setting.admin.assessment.criteria')->withSuccess('แก้ไขรายการสำเร็จ');
    }
    public function Delete($id){
        Criteria::find($id)->delete();
        return redirect()->route('setting.admin.assessment.criteria')->withSuccess('แก้ไขรายการสำเร็จ');
    }
}
