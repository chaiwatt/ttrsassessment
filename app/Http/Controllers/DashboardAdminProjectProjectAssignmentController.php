<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectProjectAssignmentController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',1)
                        ->where('status',0)->delete();
        $projectassignments = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->get();
        if($auth->user_type_id >= 6){
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
        $auth = Auth::user();
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

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 4;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $request->leader;
        $notificationbubble->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = User::find($request->leader)->id;
        $alertmessage->detail = 'ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitbp->project . ' โปรดตรวจสอบเอกสาร Mini Tbp ในขั้นตอนต่อไป ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = User::find($request->coleader)->id;
        $alertmessage->detail = 'ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitbp->project . ' โปรดตรวจสอบเอกสาร Mini Tbp ในขั้นตอนต่อไป ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        EmailBox::send(User::find($request->leader)->email,'TTRS:มอบหมาย Leader โครงการ','เรียนคุณ'.User::find($request->leader)->name. ' ' .User::find($request->leader)->lastname. '<br> ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        EmailBox::send(User::find($request->coleader)->email,'TTRS:มอบหมาย Co-Leader โครงการ','เรียนคุณ'.User::find($request->coleader)->name. ' ' .User::find($request->coleader)->lastname.'<br> ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');

        Message::sendMessage('มอบหมาย Leader โครงการ','เรียนคุณ'.User::find($request->leader)->name .' ' . User::find($request->leader)->lastname.'<br> ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::find($request->leader)->id);
        Message::sendMessage('มอบหมาย Co-Leader โครงการ','เรียนคุณ'.User::find($request->coleader)->name .' ' . User::find($request->coleader)->lastname.'<br> ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitbp->project.' โปรดตรวจสอบข้อมูล ได้ที่ <a href='.route('dashboard.admin.project.minitbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::find($request->coleader)->id);
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
