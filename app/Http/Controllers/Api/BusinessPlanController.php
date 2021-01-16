<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\NotificationBubble;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BusinessPlanController extends Controller
{
    public function Update(Request $request){
        $status = 1;
        $auth = Auth::user();
        if($request->status == 1){
            $status = 2;
            $_businessplan = BusinessPlan::find($request->id);
            $_company = Company::find($_businessplan->company_id);
            $_user = User::find($_company->user_id);
            $minitbp = MiniTBP::where('business_plan_id', $_businessplan->id)->first();
            $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
            $projectmember = ProjectMember::where('full_tbp_id',$fulltbp->id)
                                        ->where('user_id',$auth->id)->first();
            if(Empty($projectmember)){
                $projectmember = new ProjectMember();
                $projectmember->full_tbp_id = $fulltbp->id;
                $projectmember->user_id = $auth->id;
                $projectmember->save();
            }
            
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $request->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_user->id;
            $alertmessage->detailDateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' คำขอประเมินธุรกิจได้รับอนุมัติให้สามารถกรอกข้อมูล Mini TBP ได้  ' ;
            $alertmessage->save();

            EmailBox::send($_user->email,'TTRS:กรอกข้อมูล Mini TBP','เรียนผู้ขอรับการประเมิน<br><br> คำขอประเมินธุรกิจของท่านได้รับอนุมัติให้สามารถกรอกข้อมูล Mini TBP ได้ที่ <a href='.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            Message::sendMessage('กรอกข้อมูล Mini TBP','คำขอประเมินธุรกิจของท่านได้รับอนุมัติให้สามารถกรอกข้อมูล Mini TBP ได้ที่ <a href='.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a>',User::where('user_type_id',6)->first()->id,$_user->id);

        }
        BusinessPlan::find($request->id)->update([
            'business_plan_status_id' => $status
        ]);
        $businessplan = BusinessPlan::find($request->id);  
        return response()->json($businessplan);  
    }
}
