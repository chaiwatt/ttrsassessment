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

class DashboardAdminReportExpertController extends Controller
{
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

        $messagebox = Message::sendMessage('ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' เสร็จแล้ว','ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' แล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail =  DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().  ' ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project .' <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ดำเนินการ</a>' ;
        $alertmessage->save();

        $fulltbps = FullTbp::where('id', $id)->get();

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' เสร็จแล้ว','เรียน Leader<br><br> ผู้เชี่ยวชาญ '.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' แล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        return redirect()->route('dashboard.admin.report')->withSuccess('คุณเข้าร่วมโครงการแล้ว');
    }
}