<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\EducationBranch;
use App\Http\Requests\CreateEducationBranchRequest;

class SettingAdminDashboardEducationBranchController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    public function Index(){
        $educationbranches = EducationBranch::get();
        return view('setting.admin.dashboard.educationbranch.index')->withEducationbranches($educationbranches);
    }
    public function Create(){
        return view('setting.admin.dashboard.educationbranch.create');
    }
    public function CreateSave(CreateEducationBranchRequest $request){
        $educationbranch = new EducationBranch();
        $educationbranch->name = $request->educationbranch;
        $educationbranch->save();
        return redirect()->route('setting.admin.dashboard.educationbranch')->withSuccess('เพิ่มสาขาการศึกษาสำเร็จ');
    }
    public function Edit($id){
        $educationbranch = EducationBranch::find($id);
        return view('setting.admin.dashboard.educationbranch.edit')->withEducationbranch($educationbranch);
    }
    public function EditSave(CreateEducationBranchRequest $request,$id){
        $educationbranch = EducationBranch::find($id)->update([
            'name' => $request->educationbranch
        ]);
        return redirect()->route('setting.admin.dashboard.educationbranch')->withSuccess('แก้ไขสาขาการศึกษาสำเร็จ');
    }
    public function Delete($id){
        EducationBranch::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.educationbranch')->withSuccess('ลบสาขาการศึกษาสำเร็จ');
    }
}
