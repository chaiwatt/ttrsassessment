<?php

namespace App\Http\Controllers;

use App\Model\ExpertDetail;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;
use App\Model\EducationLevel;
use App\Model\EmployEducation;
use App\Http\Requests\CreateEducationLevelRequest;

class SettingAdminDashboardEducationLevelController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:0,4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $educationlevels = EducationLevel::get();
        return view('setting.admin.dashboard.educationlevel.index')->withEducationlevels($educationlevels);
    }
    public function Create(){
        return view('setting.admin.dashboard.educationlevel.create');
    }
    public function CreateSave(CreateEducationLevelRequest $request){
        $check = EducationLevel::where('name',$request->educationlevel)->first();
        if(!Empty($check)){
            return redirect()->route('setting.admin.dashboard.educationlevel')->withError('มีการใช้ระดับการศึกษานี้แล้ว');
        }
        $educationlevel = new EducationLevel();
        $educationlevel->name = $request->educationlevel;
        $educationlevel->save();
        return redirect()->route('setting.admin.dashboard.educationlevel')->withSuccess('เพิ่มระดับการศึกษาสำเร็จ');
    }
    public function Edit($id){
        $educationlevel = EducationLevel::find($id);
        return view('setting.admin.dashboard.educationlevel.edit')->withEducationlevel($educationlevel);
    }
    public function EditSave(CreateEducationLevelRequest $request,$id){

        $check_expert_detail_educationlevel = ExpertDetail::where('education_level_id',$id)->get();
        $check_officer_detail_educationlevel = OfficerDetail::where('education_level_id',$id)->get();
        $check_employ_educationlevel = EmployEducation::where('employeducationlevel',$id)->get();

        if($check_expert_detail_educationlevel->count() != 0 || $check_officer_detail_educationlevel->count() != 0 || $check_employ_educationlevel->count() != 0){
            return redirect()->route('setting.admin.dashboard.educationlevel')->withError('มีการใช้ระดับการศึกษานี้แล้ว');
        }

        $educationlevel = EducationLevel::find($id)->update([
            'name' => $request->educationlevel
        ]);
        return redirect()->route('setting.admin.dashboard.educationlevel')->withSuccess('แก้ไขระดับการศึกษาสำเร็จ');
    }
    public function Delete($id){
        $check_expert_detail_educationlevel = ExpertDetail::where('education_level_id',$id)->get();
        $check_officer_detail_educationlevel = OfficerDetail::where('education_level_id',$id)->get();
        $check_employ_educationlevel = EmployEducation::where('employeducationlevel',$id)->get();

        if($check_expert_detail_educationlevel->count() != 0 || $check_officer_detail_educationlevel->count() != 0 || $check_employ_educationlevel->count() != 0){
            return redirect()->route('setting.admin.dashboard.educationlevel')->withError('มีการใช้ระดับการศึกษานี้แล้ว');
        }
        EducationLevel::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.educationlevel')->withSuccess('ลบระดับการศึกษาสำเร็จ');
    }
}
