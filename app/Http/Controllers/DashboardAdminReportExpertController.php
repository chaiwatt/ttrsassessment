<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Helper\UserArray;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
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
        $company_name = (!Empty($businessplan->company->name))?$businessplan->company->name:'';
        $bussinesstype = $businessplan->company->business_type_id;

        $fullcompanyname = ' ' . $company_name;
        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $messagebox = Message::sendMessage('คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname,'คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname. ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);
        
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail =  DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().  ' คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname . ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);
        $jduser = User::where('user_type_id',6)->first();
        $fulltbps = FullTbp::where('id', $id)->get();
        EmailBox::send(User::find($projectassignment->leader_id)->email,$jduser->email,'TTRS: คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname,'เรียน Leader<br><br> คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname. ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        

        $messagebox = Message::sendMessage('คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname,'คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname. ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$jduser->id);
        
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jduser->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail =  DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().  ' คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname . ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        // EmailBox::send($jduser->email,'','TTRS: คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname,'เรียน Manager<br><br> คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project .$fullcompanyname. ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

        $arr1 = User::where('id',$auth->id)->pluck('id')->toArray();
        $arr2 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr3 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2,$arr3));

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->viewer = $userarray;
        $projectlog->action = 'ตอบรับเป็นผู้เชี่ยวชาญ';
        $projectlog->save();

        CreateUserLog::createLog('ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project);
        return redirect()->route('dashboard.admin.report')->withSuccess('คุณได้ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project);
    }
}
