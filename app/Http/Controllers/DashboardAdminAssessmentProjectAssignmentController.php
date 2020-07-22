<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\MiniTBP;
use App\Helper\EmailBox;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardAdminAssessmentProjectAssignmentController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        $projectassignments = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->get();
        if($auth->user_type_id >= 7){
            $projectassignments = ProjectAssignment::get();
        }
        return view('dashboard.admin.assessment.projectassignment.index')->withProjectassignments($projectassignments);
    }
    public function Edit($id){
        $projectassignment = ProjectAssignment::find($id);
        $minitbp = MiniTBP::where('business_plan_id',BusinessPlan::find($projectassignment->business_plan_id)->id)->first();
        $users = User::where('user_type_id','>=',4)->get();
        return view('dashboard.admin.assessment.projectassignment.edit')->withProjectassignment($projectassignment)
                                                            ->withUsers($users)
                                                            ->withMinitbp($minitbp);
    }
    public function EditSave(Request $request,$id){
        ProjectAssignment::find($id)->update([
            'leader_id' => $request->leader,
            'coleader_id' => $request->coleader,
        ]);
        $businessplan = BusinessPlan::find(ProjectAssignment::find($id)->business_plan_id);
        $minitpb = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        EmailBox::send(User::find($request->leader)->email,'TTRS:Assign โครงการ','เรียน '.User::find($request->leader)->name.'<br> ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitpb->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.assessment.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        EmailBox::send(User::find($request->coleader)->email,'TTRS:Assign โครงการ','เรียน '.User::find($request->coleader)->name.'<br> ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitpb->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.assessment.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        return redirect()->route('dashboard.admin.assessment.projectassignment')->withSuccess('Assign สำเร็จ');
    }
}
