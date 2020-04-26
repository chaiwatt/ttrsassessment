<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\RegisteredCapitalType;
use App\Http\Requests\CreateRegisteredCapitalType;

class SettingDashboardRegisteredCapitalTypeController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    public function Index(){
        $registeredcapitaltypes = RegisteredCapitalType::get();
        return view('setting.dashboard.registeredcapitaltype.index')->withRegisteredcapitaltypes($registeredcapitaltypes);
    }
    public function Create(){
        return view('setting.dashboard.registeredcapitaltype.create');
    }
    public function CreateSave(CreateRegisteredCapitalType $request){
        $registeredcapitaltype = new RegisteredCapitalType();
        $registeredcapitaltype->name = $request->name;
        $registeredcapitaltype->detail = $request->detail;
        $registeredcapitaltype->min = $request->min;
        $registeredcapitaltype->max = $request->max;
        $registeredcapitaltype->save();
        return redirect()->route('setting.dashboard.registeredcapitaltype')->withSuccess('เพิ่มรายการจดทะเบียนสำเร็จ');
    }
    public function Edit($id){
        $registeredcapitaltype = RegisteredCapitalType::find($id);
        return view('setting.dashboard.registeredcapitaltype.edit')->withRegisteredcapitaltype($registeredcapitaltype);
    }
    public function EditSave(CreateRegisteredCapitalType $request,$id){
        $registeredcapitaltype = RegisteredCapitalType::find($id)->update([
            'name' => $request->name,
            'detail' => $request->detail,
            'min' => $request->min,
            'max' => $request->max,
        ]);
        return redirect()->route('setting.dashboard.registeredcapitaltype')->withSuccess('แก้ไขรายการจดทะเบียนสำเร็จ');
    }
}
