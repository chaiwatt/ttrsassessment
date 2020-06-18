<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\RegisteredCapitalType;
use App\Http\Requests\CreateRegisteredCapitalType;

class SettingAdminDashboardRegisteredCapitalTypeController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $registeredcapitaltypes = RegisteredCapitalType::get();
        return view('setting.admin.dashboard.registeredcapitaltype.index')->withRegisteredcapitaltypes($registeredcapitaltypes);
    }
    public function Create(){
        return view('setting.admin.dashboard.registeredcapitaltype.create');
    }
    public function CreateSave(CreateRegisteredCapitalType $request){
        $registeredcapitaltype = new RegisteredCapitalType();
        $registeredcapitaltype->name = $request->name;
        $registeredcapitaltype->detail = $request->detail;
        $registeredcapitaltype->min = $request->min;
        $registeredcapitaltype->max = $request->max;
        $registeredcapitaltype->save();
        return redirect()->route('setting.admin.dashboard.registeredcapitaltype')->withSuccess('เพิ่มรายการจดทะเบียนสำเร็จ');
    }
    public function Edit($id){
        $registeredcapitaltype = RegisteredCapitalType::find($id);
        return view('setting.admin.dashboard.registeredcapitaltype.edit')->withRegisteredcapitaltype($registeredcapitaltype);
    }
    public function EditSave(CreateRegisteredCapitalType $request,$id){
        $registeredcapitaltype = RegisteredCapitalType::find($id)->update([
            'name' => $request->name,
            'detail' => $request->detail,
            'min' => $request->min,
            'max' => $request->max,
        ]);
        return redirect()->route('setting.admin.dashboard.registeredcapitaltype')->withSuccess('แก้ไขรายการจดทะเบียนสำเร็จ');
    }
    public function Delete($id){
        RegisteredCapitalType::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.registeredcapitaltype')->withSuccess('ลบรายการจดทะเบียนสำเร็จ');
    }
}
