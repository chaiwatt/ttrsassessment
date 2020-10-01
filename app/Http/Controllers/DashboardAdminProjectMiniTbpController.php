<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Model\ThaiBank;
use App\Helper\EmailBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\SignatureStatus;
use App\Model\TimeLineHistory;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectMiniTbpController extends Controller
{
    public function Index(){
        NotificationBubble::where('target_user_id',Auth::user()->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',4)
                        ->where('status',0)->delete();
        $projectassignments = ProjectAssignment::where('leader_id',Auth::user()->id)->pluck('business_plan_id')->toArray();
        // $businessplans = BusinessPlan::where('business_plan_status_id',3)->whereIn('id',$projectassignments)->pluck('id')->toArray();
        $businessplans = BusinessPlan::whereIn('id',$projectassignments)->pluck('id')->toArray();
        if(Auth::user()->user_type_id >= 6){
            $businessplans = BusinessPlan::where('business_plan_status_id',3)->pluck('id')->toArray();
        }
        $minitbps = MiniTBP::whereIn('business_plan_id',$businessplans)->get();
        return view('dashboard.admin.project.minitbp.index')->withMinitbps($minitbps);
    }

    public function View($id){
        $banks = ThaiBank::get();
        $minitbp = MiniTBP::find($id);
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        $signaturestatuses = SignatureStatus::get();
        $timelinehistories = TimeLineHistory::where('business_plan_id',$minitbp->business_plan_id)
                                            ->where('message_type',1)
                                            ->get();
        return view('dashboard.admin.project.minitbp.view')->withMinitbp($minitbp)
                                                ->withBanks($banks)
                                                ->withContactprefixes($contactprefixes)
                                                ->withContactpositions($contactpositions)
                                                ->withSignaturestatuses($signaturestatuses)
                                                ->withTimelinehistories($timelinehistories);
    }
    public function Approve($id){
        $minitbp = MiniTBP::find($id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 4
        ]);
        
        $_businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $_company = Company::find($_businessplan->company_id);
        $_user = User::find($_company->user_id);
        EmailBox::send($_user->email,'TTRS:กรอกข้อมูล Full Tbp','เรียนผู้ประกอบการ<br> เอกสาร Mini Tbp ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full Tbp ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        Message::sendMessage('กรอกข้อมูล Full Tbp','เรียนผู้ประกอบการ<br> เอกสาร Mini Tbp ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full Tbp ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
        
        return redirect()->back()->withSuccess('ยืนยัน Mini Tbp สำเร็จ');
    }

    public function EditApprove(Request $request){
        $auth = Auth::user();
        $minitbp = MiniTBP::find($request->id);
        $_businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $_company = Company::find($_businessplan->company_id);
        $_user = User::find($_company->user_id);
        if($request->val == 1){
            BusinessPlan::find($minitbp->business_plan_id)->update([
                'business_plan_status_id' => 4
            ]);
            
            if($minitbp->refixstatus != 0){
                MiniTBP::find($request->id)->update(
                    [
                        'refixstatus' => 0
                    ]
                );
            }

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_company->user_id;
            $alertmessage->detail = 'เอกสาร Mini Tbp ของท่านได้รับอนุมัติแล้วให้สามารถกรอกข้อมูล Full Tbp ได้ ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();

            EmailBox::send($_user->email,'TTRS:กรอกข้อมูล Full Tbp','เรียนผู้ประกอบการ<br> เอกสาร Mini Tbp ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full Tbp ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('กรอกข้อมูล Full Tbp','เรียนผู้ประกอบการ<br> เอกสาร Mini Tbp ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full Tbp ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
            
            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = 'เอกสาร Mini Tbp ของท่านได้รับอนุมัติ';
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();
            
        }else{
            MiniTBP::find($request->id)->update(
                [
                    'refixstatus' => 1
                ]
            );

            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = $request->note;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_company->user_id;
            $alertmessage->detail = 'ให้แก้ไขข้อมูล Mini Tbp ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString()); 
            $alertmessage->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();

            EmailBox::send($_user->email,'TTRS:แก้ไขข้อมูล Mini Tbp','เรียนผู้ประกอบการ<br> เอกสาร Mini Tbp ของท่านยังไม่ได้รับการอนุมัติ โปรดเข้าสู่ระบบเพื่อทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br>' .$request->note.  '<br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('แก้ไขข้อมูล Mini Tbp','เรียนผู้ประกอบการ<br> เอกสาร Mini Tbp ของท่านยังไม่ได้รับการอนุมัติ โปรดทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br>' .$request->note. '<br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
        }

        return response()->json($minitbp); 
    }
}
