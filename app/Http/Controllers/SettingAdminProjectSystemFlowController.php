<?php

namespace App\Http\Controllers;

use App\Model\ProjectFlow;
use Illuminate\Http\Request;

class SettingAdminProjectSystemFlowController extends Controller
{
    public function Index(){
        $projectflows = ProjectFlow::get();
        return view('setting.admin.system.projectflow.index')->withProjectflows($projectflows);
    }
    public function Edit($id){
        $projectflow = ProjectFlow::find($id);
        return view('setting.admin.system.projectflow.edit')->withProjectflow($projectflow);
    }
    public function EditSave(Request $request,$id){
        ProjectFlow::find($id)->update([
            'duration' => $request->duration
        ]);
        return redirect()->route('setting.admin.system.projectflow')->withSuccess('แก้ไขรายการสำเร็จ');
    }
}
