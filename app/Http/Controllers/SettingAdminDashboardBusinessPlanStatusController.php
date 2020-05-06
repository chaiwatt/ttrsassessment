<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessPlanStatus;
use App\Http\Requests\CreateBusinessPlanStatuRequest;

class SettingAdminDashboardBusinessPlanStatusController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
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
