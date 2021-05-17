<?php

namespace App\Http\Controllers;

use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\BusinessPlanStatus;
use App\Http\Requests\CreateBusinessPlanStatuRequest;

class SettingAdminDashboardBusinessPlanStatusController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $businessplanstatuses = BusinessPlanStatus::get();
        return view('setting.admin.dashboard.businessplanstatus.index')->withBusinessplanstatuses($businessplanstatuses);
    }
    public function Create(){
        return view('setting.admin.dashboard.businessplanstatus.create');
    }
    public function CreateSave(CreateBusinessPlanStatuRequest $request){
        $businessplanstatus = new BusinessPlanStatus();
        $businessplanstatus->name = $request->businessplanstatus;
        $businessplanstatus->save();
        return redirect()->route('setting.admin.dashboard.businessplanstatus')->withSuccess('เพิ่มสถานะการวางแผนธุรกิจ');
    }
    public function Edit($id){
        $businessplanstatus = BusinessPlanStatus::find($id);
        return view('setting.admin.dashboard.businessplanstatus.edit')->withBusinessplanstatus($businessplanstatus);
    }
    public function EditSave(CreateBusinessPlanStatuRequest $request,$id){
        $check = BusinessPlan::where('business_plan_status_id',$id)->first();
        if(!Empty($check)){
            return redirect()->route('setting.admin.dashboard.businessplanstatus')->withError('มีการใช้สถานะความก้าวหน้าโครงการนี้แล้ว');
        }

        $businessplanstatus = BusinessPlanStatus::find($id)->update([
            'name' => $request->businessplanstatus
        ]);
        return redirect()->route('setting.admin.dashboard.businessplanstatus')->withSuccess('แก้ไขสถานะการวางแผนธุรกิจ');
    }
    public function Delete($id){
        BusinessPlanStatus::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.businessplanstatus')->withSuccess('ลบสถานะการวางแผนธุรกิจ');
    }
}
