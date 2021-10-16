<?php

namespace App\Http\Controllers;

use App\Model\ExtraCategory;
use App\Model\ExtraCriteria;
use Illuminate\Http\Request;
use App\Model\CriteriaTransaction;
use App\Model\ExtraCriteriaTransaction;

class SettingAdminAssessmentExtraCriteriaController extends Controller
{
    public function Index(){
        $extracriterias = ExtraCriteria::get();
        return view('setting.admin.assessment.extracriteria.index')->withExtracriterias($extracriterias);
    }
    
    public function Create(){
        $extracaterories = ExtraCategory::get();
        return view('setting.admin.assessment.extracriteria.create')->withExtracaterories($extracaterories);
    }

    public function CreateSave(Request $request){
        if(Empty($request->extracategory) || Empty($request->extracriteria)){
            return redirect()->back()->withError('กรุณากรอกข้อมูลให้ครบถ้วน');
        }

        $extracriteria =  new ExtraCriteria();
        $extracriteria->extra_category_id = $request->extracategory;
        $extracriteria->name = $request->extracriteria;
        $extracriteria->save();
        return redirect()->route('setting.admin.assessment.extracriteria')->withSuccesss('เพิ่ม Extra Criteria สำเร็จ');
    }

    public function Edit($id){
        $extracriteria = ExtraCriteria::find($id);
        $extracaterories = ExtraCategory::get();
        return view('setting.admin.assessment.extracriteria.edit')->withExtracaterories($extracaterories)->withExtracriteria($extracriteria);
    }
    public function EditSave(Request $request,$id){
        if(Empty($request->extracategory) || Empty($request->extracriteria)){
            return redirect()->back()->withError('กรุณากรอกข้อมูลให้ครบถ้วน');
        }

        $check = ExtraCriteriaTransaction::where('extra_criteria_id',$id)->count();
   
        if($check !=0 ){
            return redirect()->route('setting.admin.assessment.extracriteria')->withError('ผิดพลาดมีการใช้ Extra Criteria นี้แล้ว');
        }else{
            $extracriteria = ExtraCriteria::find($id)->update([
                'extra_category_id' => $request->extracategory,
                'name' => $request->extracriteria
            ]); 
        }

        return redirect()->route('setting.admin.assessment.extracriteria')->withSuccess('แก้ไข Extra Criteria สำเร็จ');
    }
    public function Delete($id){
        $check = ExtraCriteriaTransaction::where('extra_criteria_id',$id)->count();
   
        if($check !=0 ){
            return redirect()->route('setting.admin.assessment.extracriteria')->withError('ผิดพลาดมีการใช้ Extra Criteria นี้แล้ว');
        }else{
            ExtraCriteria::find($id)->delete(); 
        }

        return redirect()->route('setting.admin.assessment.extracriteria')->withSuccess('ลบ Extra Criteria สำเร็จ');
    }
}
