<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Model\ThaiBank;
use App\Helper\EmailBox;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use Illuminate\Http\Request;
use App\Model\SignatureStatus;
use App\Model\TimeLineHistory;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectMiniTbpController extends Controller
{
    public function Index(){
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
        EmailBox::send($_user->email,'TTRS:กรอกข้อมูล Full TBP','เรียนผู้ประกอบการ<br> เอกสาร Mini TBP ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full TBP ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        Message::sendMessage('กรอกข้อมูล Full TBP','เรียนผู้ประกอบการ<br> เอกสาร Mini TBP ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full TBP ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
        
        return redirect()->back()->withSuccess('ยืนยัน mini TBP สำเร็จ');
    }

    public function EditApprove(Request $request){
        $minitbp = MiniTBP::find($request->id);
        $_businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $_company = Company::find($_businessplan->company_id);
        $_user = User::find($_company->user_id);
        if($request->val == 1){
            BusinessPlan::find($minitbp->business_plan_id)->update([
                'business_plan_status_id' => 4
            ]);
            EmailBox::send($_user->email,'TTRS:กรอกข้อมูล Full TBP','เรียนผู้ประกอบการ<br> เอกสาร Mini TBP ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full TBP ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('กรอกข้อมูล Full TBP','เรียนผู้ประกอบการ<br> เอกสาร Mini TBP ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full TBP ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = 'เอกสาร Mini TBP ของท่านได้รับอนุมัติ';
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->user_id = Auth::user()->id;
            $timeLinehistory->save();
        }else{
            EmailBox::send($_user->email,'TTRS:แก้ไขข้อมูล Mini TBP','เรียนผู้ประกอบการ<br> เอกสาร Mini TBP ของท่านยังไม่ได้รับการอนุมัติ โปรดเข้าสู่ระบบเพื่อทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br>' .$request->note.  '<br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('แก้ไขข้อมูล Mini TBP','เรียนผู้ประกอบการ<br> เอกสาร Mini TBP ของท่านยังไม่ได้รับการอนุมัติ โปรดทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br>' .$request->note. '<br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = $request->note;
            $timeLinehistory->user_id = Auth::user()->id;
            $timeLinehistory->message_type = 1;
            $timeLinehistory->owner_id = $_company->user_id;
            $timeLinehistory->save();
        }
        return response()->json($minitbp); 
    }
}
