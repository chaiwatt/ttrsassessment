<?php

namespace App\Http\Controllers;

use App\Model\ExtraCategory;
use Illuminate\Http\Request;
use App\Model\ExtraCriteriaTransaction;

class SettingAdminAssessmentExtraCategoryController extends Controller
{
    public function Index(){
        $extracaterories = ExtraCategory::get();
        return view('setting.admin.assessment.extracategory.index')->withExtracaterories($extracaterories);
    }
    public function Create(){
        return view('setting.admin.assessment.extracategory.create');
    }
    public function CreateSave(Request $request){
        $extracaterory = new ExtraCategory();
        $extracaterory->name = $request->name;
        $extracaterory->save();
        return redirect()->route('setting.admin.assessment.extracategory')->withSuccess('เพิ่ม Extra Category สำเร็จ');
    }
    public function Edit($id){
        $extracaterory = ExtraCategory::find($id);
        return view('setting.admin.assessment.extracategory.edit')->withExtracaterory($extracaterory);
    }
    public function EditSave(Request $request,$id){
        $check = ExtraCriteriaTransaction::where('extra_category_id',$id)->count();
        if($check != 0){
           return redirect()->route('setting.admin.assessment.extracategory')->withError('ผิดพลาดมีการใช้ Extra Category นี้แล้ว');
        }else{
            ExtraCategory::find($id)->update([
                'name' =>  $request->name
            ]);
            return redirect()->route('setting.admin.assessment.extracategory')->withSuccess('แก้ไข Extra Category สำเร็จ');
        }
    }
    public function Delete($id){
        $check = ExtraCriteriaTransaction::where('extra_category_id',$id)->count();
        if($check != 0){
           return redirect()->route('setting.admin.assessment.extracategory')->withError('ผิดพลาดมีการใช้ Extra Category นี้แล้ว');
        }else{
            ExtraCategory::find($id)->delete();
            return redirect()->route('setting.admin.assessment.extracategory')->withSuccess('ลบ Extra Category สำเร็จ');
        }
    }
}
