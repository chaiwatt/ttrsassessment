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
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;

class DashboardExpertReportController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        $userids = User::find($auth->id)->pluck('id')->toArray();
        $fulltbptids = ExpertAssignment::whereIn('user_id', $userids)
                                    ->where('expert_assignment_status_id',2)
                                    ->pluck('full_tbp_id')
                                    ->toArray();
        $fulltbps = FullTbp::whereIn('id', $fulltbptids)->get();
        $alertmessages = AlertMessage::where('target_user_id',$auth->id)->get();
        return view('dashboard.expert.report.index')->withFulltbps($fulltbps)
                                                    ->withAlertmessages($alertmessages);
    }
    public function Accept($id){
        $auth = Auth::user();
        ExpertAssignment::where('full_tbp_id', $id)
                    ->where('user_id',$auth->id)
                    ->first()
                    ->update([
                        'accepted' => '1'
                    ]);

        $fulltbp = FullTbp::find($id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $projectassignment->leader_id;
        $alertmessage->detail = 'ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project .' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        $fulltbps = FullTbp::where('id', $id)->get();

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' เสร็จแล้ว','เรียน Leader<br> ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' แล้ว โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        Message::sendMessage('ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' เสร็จแล้ว','ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' เสร็จแล้ว โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$projectassignment->leader_id);

        return redirect()->route('dashboard.expert.report')->withSuccess('คุณเข้าร่วมโครงการแล้ว');
    }
    public function Reject($id){
        $auth = Auth::user();
        ExpertAssignment::where('full_tbp_id', $id)
                     ->where('user_id',$auth->id)
                     ->first()
                     ->update([
                         'accepted' => '2'
                     ]);

            $fulltbp = FullTbp::find($id);
            $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
            
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 5;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $projectassignment->leader_id;
            $notificationbubble->save();
            
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =  $projectassignment->leader_id;
            $alertmessage->detail = 'ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project .' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();

            $fulltbps = FullTbp::where('id', $id)->get();
         
            EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ,'เรียน Leader<br> ผู้เชี่ยวชาญตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' แล้ว โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ,'ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$projectassignment->leader_id);

         return redirect()->route('dashboard.expert.report')->withSuccess('คุณปฎิเสธเข้าร่วมโครงการแล้ว');
     }
}
