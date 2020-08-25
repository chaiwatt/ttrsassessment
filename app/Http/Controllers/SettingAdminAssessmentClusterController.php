<?php

namespace App\Http\Controllers;

use App\Model\Cluster;
use Illuminate\Http\Request;
// use App\Model\AssessmentGroup;

class SettingAdminAssessmentClusterController extends Controller
{
    public function Index(){
        $evs = Ev::get();
        return view('setting.admin.assessment.ev.index')->withEvs($evs);
    }
    public function Create(){
        $clusters = Cluster::get();
        return view('setting.admin.assessment.ev.create')->withClusters($clusters);
    }
    public function CreateSave(Request $request){
        $ev = new Ev();
        $ev->name = $request->name;
        $ev->version = $request->version;
        $ev->save();
        return redirect()->route('setting.admin.assessment.ev')->withSuccess('เพิ่มรายการสำเร็จ');
    }
    public function EditCLuster($id){
        $ev = Ev::find($id);
        return view('setting.admin.assessment.ev.editcluster')->withAssessmentgroup($assessmentgroup);
    }
}
