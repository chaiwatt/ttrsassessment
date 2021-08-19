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
use Illuminate\Support\Facades\Auth;

class DashboardAdminFollowUpController extends Controller
{
    public function Index(){
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.followup.index')->withFulltbps($fulltbps);
    }
    public function Edit($id){
        $fulltbp = FullTbp::find($id);
        return view('dashboard.admin.followup.edit')->withFulltbp($fulltbp);
    }
    public function EditSave(Request $request,$id){
        $auth = Auth::user();
        FullTbp::find($id)->update([
            'success_objective' => $request->followup,
            'follow_reason' => $request->note,
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
            $messagebox = Message::sendMessage('เพิ่มผลการติดตามโครงการ โครงการ'.$minitbp->project  . $fullcompanyname,'เพิ่มผลการติดตามโครงการ โครงการ'.$minitbp->project . $fullcompanyname,$auth->id,$projectmember->user_id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $projectmember->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' เพิ่มผลการติดตามโครงการ โครงการ'.$minitbp->project . $fullcompanyname;
            $alertmessage->save();
    
            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
            EmailBox::send($_user->email,'','TTRS:เพิ่มผลการติดตามโครงการ โครงการ'.$minitbp->project . $fullcompanyname,'เรียน ผู้เชี่ยวชาญ <br><br> คุณ'.$auth->name. ' '.$auth->lastname.' ได้เพิ่มผลการติดตามโครงการ โครงการ'.$minitbp->project. $fullcompanyname.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }

        $result = 'บรรลุตามจุดประสงค์';
        if($request->followup == 2 ){
            $result = 'ไม่บรรลุตามจุดประสงค์';
        }

        $arr1 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr2 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2));

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->viewer = $userarray;
        $projectlog->action = 'เพิ่มผลการติดตามโครงการ (รายละเอียด: ' .$result. ')';
        $projectlog->save();

        CreateUserLog::createLog('เพิ่มผลการติดตามโครงการ');

        return redirect()->route('dashboard.admin.followup')->withSuccess('อัพเดทรายการสำเร็จ');
    }
    public function View($id){
        $fulltbp = FullTbp::find($id);
        return view('dashboard.admin.followup.view')->withFulltbp($fulltbp);
    }
}
