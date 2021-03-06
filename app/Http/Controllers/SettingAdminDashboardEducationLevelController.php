<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\EducationLevel;
use App\Http\Requests\CreateEducationLevelRequest;

class SettingAdminDashboardEducationLevelController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $educationlevels = EducationLevel::get();
        return view('setting.admin.dashboard.educationlevel.index')->withEducationlevels($educationlevels);
    }
    public function Create(){
        return view('setting.admin.dashboard.educationlevel.create');
    }
    public function CreateSave(CreateEducationLevelRequest $request){
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
        $educationlevel = EducationLevel::find($id)->update([
            'name' => $request->educationlevel
        ]);
        return redirect()->route('setting.admin.dashboard.educationlevel')->withSuccess('แก้ไขระดับการศึกษาสำเร็จ');
    }
    public function Delete($id){
        EducationLevel::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.educationlevel')->withSuccess('ลบระดับการศึกษาสำเร็จ');
    }
}
