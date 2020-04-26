<?php

namespace App\Http\Controllers;

use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Http\Requests\CrIndustryGroupRequest;

class SettingDashboardIndustryGroupController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    public function Index(){
        $industrygroups = IndustryGroup::get();
        return view('setting.dashboard.industrygroup.index')->withIndustrygroups($industrygroups);
    }
    public function Create(){
        return view('setting.dashboard.industrygroup.create');
    }
    public function CreateSave(CrIndustryGroupRequest $request){
        $industrygroup = new IndustryGroup();
        $industrygroup->name = $request->industrygroup;
        $industrygroup->save();
        return redirect()->route('setting.dashboard.industrygroup')->withSuccess('เพิ่มกลุ่มอุตสาหกรรมสำเร็จ');
    }
    public function Edit($id){
        $industrygroup = IndustryGroup::find($id);
        return view('setting.dashboard.industrygroup.edit')->withIndustrygroup($industrygroup);
    }
    public function EditSave(CrIndustryGroupRequest $request,$id){
        $industrygroup = IndustryGroup::find($id)->update([
            'name' => $request->industrygroup
        ]);
        return redirect()->route('setting.dashboard.industrygroup')->withSuccess('แก้ไขกลุ่มอุตสาหกรรมสำเร็จ');
    }
    public function Delete($id){
        IndustryGroup::find($id)->delete();
        return redirect()->route('setting.dashboard.industrygroup')->withSuccess('ลบกลุ่มอุตสาหกรรมสำเร็จ');
    }
}
