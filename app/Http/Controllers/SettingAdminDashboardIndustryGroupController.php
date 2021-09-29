<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Http\Requests\CrIndustryGroupRequest;

class SettingAdminDashboardIndustryGroupController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:0,4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $industrygroups = IndustryGroup::get();
        return view('setting.admin.dashboard.industrygroup.index')->withIndustrygroups($industrygroups);
    }
    public function Create(){
        return view('setting.admin.dashboard.industrygroup.create');
    }
    public function CreateSave(CrIndustryGroupRequest $request){
        $industrygroup = new IndustryGroup();
        $industrygroup->name = $request->industrygroup;
        $industrygroup->save();
        return redirect()->route('setting.admin.dashboard.industrygroup')->withSuccess('เพิ่มกลุ่มอุตสาหกรรมสำเร็จ');
    }
    public function Edit($id){
        $industrygroup = IndustryGroup::find($id);
        return view('setting.admin.dashboard.industrygroup.edit')->withIndustrygroup($industrygroup);
    }
    public function EditSave(CrIndustryGroupRequest $request,$id){
        $check = Company::where('industry_group_id',$id)->first();
        if(!Empty($check)){
            return redirect()->route('setting.admin.dashboard.industrygroup')->withError('มีการใช้กลุ่มอุตสาหกรรมนี้แล้ว');
        }
        $industrygroup = IndustryGroup::find($id)->update([
            'name' => $request->industrygroup
        ]);
        return redirect()->route('setting.admin.dashboard.industrygroup')->withSuccess('แก้ไขกลุ่มอุตสาหกรรมสำเร็จ');
    }
    public function Delete($id){
        $check = Company::where('industry_group_id',$id)->first();
        if(!Empty($check)){
            return redirect()->route('setting.admin.dashboard.industrygroup')->withError('มีการใช้กลุ่มอุตสาหกรรมนี้แล้ว');
        }
        IndustryGroup::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.industrygroup')->withSuccess('ลบกลุ่มอุตสาหกรรมสำเร็จ');
    }
}
