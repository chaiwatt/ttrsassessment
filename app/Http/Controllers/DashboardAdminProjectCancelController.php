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
use App\Model\ProjectLog;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Model\TimeLineHistory;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectCancelController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::orderBy('canceldate','asc')->get();
        return view('dashboard.admin.project.projectcancel.index')->withFulltbps($fulltbps);
    }

    public function cancel($id){
        $fulltbp = FullTbp::find($id);
        return view('dashboard.admin.project.projectcancel.edit')->withFulltbp($fulltbp);
    }    

    public function savecancel(Request $request,$id){
        $auth = Auth::user();
        FullTbp::find($id)->update([
            'canceldate' => Carbon::now()->toDateString(),
            'cancel_reason' => $request->cancelreason
        ]);

        $fulltbp = FullTbp::find($id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        
        $projectmembers = ProjectMember::where('full_tbp_id',$fulltbp->id)->get();

        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);

        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;
        $fullcompanyname = $company_name;

        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        foreach ($projectmembers as $key => $projectmember) {
            $_user = User::find($projectmember->user_id);
            $messagebox = Message::sendMessage('ยกเลิกโครงการ โครงการ'.$minitbp->project  . $fullcompanyname,'ยกเลิกโครงการ โครงการ'.$minitbp->project . $fullcompanyname.' เสร็จเรียบร้อยแล้ว',$auth->id,$projectmember->user_id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $projectmember->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' ยกเลิกโครงการ โครงการ'.$minitbp->project.$fullcompanyname .' เสร็จเรียบร้อยแล้ว';
            $alertmessage->save();
    
            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
            EmailBox::send($_user->email,'TTRS:ยกเลิกโครงการ โครงการ'.$minitbp->project   . $fullcompanyname,'เรียน ผู้เชี่ยวชาญ <br><br> คุณ'.$auth->name . ' '.$auth->lastname.' ได้ยกเลิกโครงการ โครงการ'.$minitbp->project.$fullcompanyname .' เสร็จเรียบร้อยแล้ว <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
        $timeLinehistory->mini_tbp_id = $minitbp->id;
        $timeLinehistory->details = 'TTRS:ยกเลิกโครงการ โครงการ'.$minitbp->project  . $fullcompanyname;
        $timeLinehistory->message_type = 3;
        $timeLinehistory->owner_id = $auth->id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'ยกเลิกโครงการ'.$minitbp->project  . $fullcompanyname. ' (รายละเอียด: ' .$request->cancelreason. ')';
        $projectlog->save();

        CreateUserLog::createLog('ยกเลิกโครงการ');

        return redirect()->route('dashboard.admin.project.projectcancel')->withSuccess('ยกเลิกโครงการสำเร็จ');
    }
}
