<?php

namespace App\Http\Controllers;

use App\Model\BusinessType;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBusinessTypeRequest;

class SettingAdminDashboardBusinessTypeController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $businesstypes = BusinessType::get();
        return view('setting.admin.dashboard.businesstype.index')->withBusinesstypes($businesstypes);
    }
    public function Create(){
        return view('setting.admin.dashboard.businesstype.create');
    }
    public function CreateSave(CreateBusinessTypeRequest $request){
        $businesstype = new BusinessType();
        $businesstype->name = $request->businesstype;
        $businesstype->save();
        return redirect()->route('setting.admin.dashboard.businesstype')->withSuccess('เพิ่มประเภทธุรกิจสำเร็จ');
    }
    public function Edit($id){
        $businesstype = BusinessType::find($id);
        return view('setting.admin.dashboard.businesstype.edit')->withBusinesstype($businesstype);
    }
    public function EditSave(CreateBusinessTypeRequest $request,$id){
        $businesstype = BusinessType::find($id)->update([
            'name' => $request->businesstype
        ]);
        return redirect()->route('setting.admin.dashboard.businesstype')->withSuccess('แก้ไขประเภทธุรกิจสำเร็จ');
    }
    public function Delete($id){
        BusinessType::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.businesstype')->withSuccess('ลบประเภทธุรกิจสำเร็จ');
    }
}
