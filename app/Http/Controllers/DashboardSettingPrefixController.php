<?php

namespace App\Http\Controllers;

use App\Model\Prefix;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePrefixRequest;

class DashboardSettingPrefixController extends Controller
{
    public function Index(){
        $prefixes = Prefix::get();
        return view('dashboard.setting.prefix.index')->withPrefixes($prefixes);
    }
    public function Create(){
        return view('dashboard.setting.prefix.create');
    }
    public function CreateSave(CreatePrefixRequest $request){
        $prefix = new Prefix();
        $prefix->name = $request->prefix;
        $prefix->save();
        return redirect()->route('dashboard.setting.prefix')->withSuccess('เพิ่มคำนำหน้าสำเร็จ');
    }
    public function Edit($id){
        $prefix = Prefix::find($id);
        return view('dashboard.setting.prefix.edit')->withPrefix($prefix);
    }
    public function EditSave(CreatePrefixRequest $request,$id){
        $prefix = Prefix::find($id)->update([
            'name' => $request->prefix
        ]);
        return redirect()->route('dashboard.setting.prefix')->withSuccess('แก้ไขคำนำหน้าสำเร็จ');
    }
}
