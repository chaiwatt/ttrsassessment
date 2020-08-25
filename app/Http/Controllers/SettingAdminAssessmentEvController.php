<?php

namespace App\Http\Controllers;

use App\Model\Ev;
use App\Model\Pilla;
use App\Model\Cluster;
use Illuminate\Http\Request;

class SettingAdminAssessmentEvController extends Controller
{
    public function Index(){
        $evs = Ev::get();
        return view('setting.admin.assessment.ev.index')->withEvs($evs);
    }
    public function Create(){
        $pillas = Pilla::get();
        return $pillas;
        return view('setting.admin.assessment.ev.create')->withClusters($clusters);
    }
    // public function CreateSave(Request $request){
    //     $ev = new Ev();
    //     $ev->name = $request->name;
    //     $ev->version = $request->version;
    //     $ev->save();
    //     return redirect()->route('setting.admin.assessment.ev')->withSuccess('เพิ่มรายการสำเร็จ');
    // }
    // public function EditCLuster($id){
    //     $ev = Ev::find($id);
    //     return view('setting.admin.assessment.ev.editcluster')->withAssessmentgroup($assessmentgroup);
    // }
}
