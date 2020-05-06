<?php

namespace App\Http\Controllers;

use App\Model\Prefix;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePrefixRequest;

class SettingAdminDashboardPrefixController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    public function Index(){
        $prefixes = Prefix::get();
        return view('setting.admin.dashboard.prefix.index')->withPrefixes($prefixes);
    }
    public function Create(){
        return view('setting.admin.dashboard.prefix.create');
    }
    public function CreateSave(CreatePrefixRequest $request){
        $prefix = new Prefix();
        $prefix->name = $request->prefix;
        $prefix->save();
        return redirect()->route('setting.admin.dashboard.prefix')->withSuccess('เพิ่มคำนำหน้าสำเร็จ');
    }
    public function Edit($id){
        $prefix = Prefix::find($id);
        return view('setting.admin.dashboard.prefix.edit')->withPrefix($prefix);
    }
    public function EditSave(CreatePrefixRequest $request,$id){
        $prefix = Prefix::find($id)->update([
            'name' => $request->prefix
        ]);
        return redirect()->route('setting.admin.dashboard.prefix')->withSuccess('แก้ไขคำนำหน้าสำเร็จ');
    }
    public function Delete($id){
        Prefix::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.prefix')->withSuccess('ลบรายการสำเร็จ');
    }
}
