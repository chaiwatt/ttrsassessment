<?php

namespace App\Http\Controllers;

use App\Model\Cluster;
use Illuminate\Http\Request;
use App\Model\AssessmentGroup;

class SettingAdminAssessmentClusterController extends Controller
{
    public function Index(){
        $assessmentgroups = AssessmentGroup::get();
        return view('setting.admin.assessment.cluster.index')->withAssessmentgroups($assessmentgroups);
    }
    public function Create(){
        $clusters = Cluster::get();
        return view('setting.admin.assessment.cluster.create')->withClusters($clusters);
    }
    public function CreateSave(Request $request){
        $assessmentgroup = new AssessmentGroup();
        $assessmentgroup->name = $request->name;
        $assessmentgroup->version = $request->version;
        $assessmentgroup->save();
        return redirect()->route('setting.admin.assessment.cluster')->withSuccess('เพิ่มรายการสำเร็จ');
    }
    public function EditCLuster($id){
        $assessmentgroup = AssessmentGroup::find($id);
        return view('setting.admin.assessment.cluster.editcluster')->withAssessmentgroup($assessmentgroup);
    }
}
