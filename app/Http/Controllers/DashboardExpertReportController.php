<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;

class DashboardExpertReportController extends Controller
{
    public function __construct() 
    { 
        $this->middleware(['auth', 'verified']);
    }
    public function Index(){
        $auth = Auth::user();
        // return $auth->user_type_id;
        // $userids = User::find($auth->id)->pluck('id')->toArray();
        $fulltbptids = ExpertAssignment::where('user_id', $auth->id)
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
        $company = Company::find($businessplan->company_id);
        
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $messagebox = Message::sendMessage('ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail =  DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().  ' ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project .' <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>' ;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'เรียน Leader<br><br> ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        $jduser = User::where('user_type_id',6)->first();
        $messagebox = Message::sendMessage('ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$jduser->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $jduser->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail =  DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().  ' ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project .' <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>ดำเนินการ</a>' ;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send($jduser->email,'TTRS:ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'เรียน JD<br><br> ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ตอบรับเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        CreateUserLog::createLog('ตอบรับเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project);
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
        $company = Company::find($businessplan->company_id);

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();
        
        $messagebox =  Message::sendMessage('ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ,'ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$projectassignment->leader_id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ;
        $alertmessage->save();
        
        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name,'เรียน Leader<br><br> ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        $jduser = User::where('user_type_id',6)->first();
        $messagebox =  Message::sendMessage('ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ,'ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$jduser->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $jduser->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ;
        $alertmessage->save();
        
        EmailBox::send($jduser->email,'TTRS:ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name,'เรียน JD<br><br> ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        CreateUserLog::createLog('ปฎิเสธการเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project);
        return redirect()->route('dashboard.expert.report')->withSuccess('คุณปฎิเสธเข้าร่วมโครงการแล้ว');
     }
}
