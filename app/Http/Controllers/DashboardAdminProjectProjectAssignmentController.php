<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectProjectAssignmentController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        $projectassignments = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->get();
        if($auth->user_type_id >= 7){
            $projectassignments = ProjectAssignment::get();
        }
        return view('dashboard.admin.project.projectassignment.index')->withProjectassignments($projectassignments);
    }
    public function Edit($id){
        $projectassignment = ProjectAssignment::find($id);
        $minitbp = MiniTBP::where('business_plan_id',BusinessPlan::find($projectassignment->business_plan_id)->id)->first();
        $users = User::where('user_type_id','>=',4)->get();
        return view('dashboard.admin.project.projectassignment.edit')->withProjectassignment($projectassignment)
                                                            ->withUsers($users)
                                                            ->withMinitbp($minitbp);
    }
    public function EditSave(Request $request,$id){
        ProjectAssignment::find($id)->update([
            'leader_id' => $request->leader,
            'coleader_id' => $request->coleader,
        ]);
        $businessplan = BusinessPlan::find(ProjectAssignment::find($id)->business_plan_id);
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $projectmember = ProjectMember::where('full_tbp_id',$fulltbp->id)
                ->where('user_id',$request->leader)->first();
        if(Empty($projectmember)){
            $projectmember = new ProjectMember();
            $projectmember->full_tbp_id = $fulltbp->id;
            $projectmember->user_id = $request->leader;
            $projectmember->save();
        }

        EmailBox::send(User::find($request->leader)->email,'TTRS:มอบหมาย Leader โครงการ','เรียน '.User::find($request->leader)->name.'<br> ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        EmailBox::send(User::find($request->coleader)->email,'TTRS:มอบหมาย Co-Leader โครงการ','เรียน '.User::find($request->coleader)->name.'<br> ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');

        Message::sendMessage('มอบหมาย Leader โครงการ','เรียน '.User::find($request->leader)->name.'<br> ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::find($request->leader)->id);
        Message::sendMessage('มอบหมาย Co-Leader โครงการ','เรียน '.User::find($request->coleader)->name.'<br> ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::find($request->coleader)->id);
        return redirect()->route('dashboard.admin.project.projectassignment')->withSuccess('Assign สำเร็จ');
    }
    public function GetWorkLoadLeader(Request $request){
        $businessplanids = ProjectAssignment::where('leader_id',$request->userid)->pluck('business_plan_id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
        $allprojects = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();

        $finishbusinessplans = BusinessPlan::whereIn('id',$businessplanids)->where('finished',1)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id',$finishbusinessplans)->pluck('id')->toArray();
        $finishedprojects = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json(array(
            "allprojects" => $allprojects,
            "finishedprojects" => $finishedprojects
        ));
    }
    public function GetWorkLoadCoLeader(Request $request){
        $businessplanids = ProjectAssignment::where('coleader_id',$request->userid)->pluck('business_plan_id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
        $allprojects = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();

        $finishbusinessplans = BusinessPlan::whereIn('id',$businessplanids)->where('finished',1)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id',$finishbusinessplans)->pluck('id')->toArray();
        $finishedprojects = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json(array(
            "allprojects" => $allprojects,
            "finishedprojects" => $finishedprojects
        ));
    }
}
