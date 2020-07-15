<?php

namespace App\Http\Controllers;

use App\Model\Criteria;
use Illuminate\Http\Request;

class SettingAdminAssessmentCriteriaController extends Controller
{
    public function Index(){
        $criterias = Criteria::get();
        return view('setting.admin.assessment.criteria.index')->withCriterias($criterias) ;
    }
    public function Create(){
        $criterias = Criteria::get();
        return view('setting.admin.assessment.criteria.create')->withCriterias($criterias) ;
    }
    public function CreateSave(Request $request){
        $criteria = new Criteria();
        $criteria->name = $request->criteria;
        $criteria->weight = $request->weight;
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
            'weight' => $request->weight
        ]);
        return redirect()->route('setting.admin.assessment.criteria')->withSuccess('แก้ไขรายการสำเร็จ');
    }
    public function Delete($id){
        Criteria::find($id)->delete();
        return redirect()->route('setting.admin.assessment.criteria')->withSuccess('แก้ไขรายการสำเร็จ');
    }
}
