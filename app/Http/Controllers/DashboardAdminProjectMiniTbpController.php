<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Model\Province;
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
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $user = User::find($company->user_id);
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        $signaturestatuses = SignatureStatus::get();
        $timelinehistories = TimeLineHistory::where('business_plan_id',$minitbp->business_plan_id)
                                            ->where('message_type',1)
                                            ->get();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$user->province_id)->get();
        $tambols = Tambol::where('amphur_id',$user->amphur_id)->get();
        return view('dashboard.admin.project.minitbp.view')->withMinitbp($minitbp)
                                                ->withBanks($banks)
                                                ->withContactprefixes($contactprefixes)
                                                ->withContactpositions($contactpositions)
                                                ->withSignaturestatuses($signaturestatuses)
                                                ->withTimelinehistories($timelinehistories)
                                                ->withUser($user)
                                                ->withUser($user)
                                                ->withProvinces($provinces)
                                                ->withAmphurs($amphurs)
                                                ->withTambols($tambols);
    }
    public function Approve($id){
        $minitbp = MiniTBP::find($id);
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $businessplan = BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 4
        ]);
        
        $_businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $_company = Company::find($_businessplan->company_id);
        $_user = User::find($_company->user_id);
        EmailBox::send($_user->email,'TTRS:กรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','เรียนผู้ประกอบการ<br><br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full TBP ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
        Message::sendMessage('กรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','เรียนผู้ประกอบการ<br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูล Full TBP ได้ที่ <a href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
        
        return redirect()->back()->withSuccess('อนุมัติแบบคำขอรับบริการประเมิน TTRS (Mini TBP) สำเร็จ');
    }

    public function EditApprove(Request $request){
        $auth = Auth::user();
        $minitbp = MiniTBP::find($request->id);
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
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
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติแล้วให้สามารถกรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ได้ <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ตรวจสอบ</a>';
            $alertmessage->save();

            EmailBox::send($_user->email,'TTRS:กรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','เรียนผู้ประกอบการ<br><br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('กรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)','เรียนผู้ประกอบการ<br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติแล้ว ให้สามารถกรอกข้อมูลแบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) <a class="btn btn-sm bg-success" href='.route('dashboard.company.project.fulltbp.edit',['id' => $fulltbp->id]).'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
            
            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = 'แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านได้รับอนุมัติ';
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
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ให้แก้ไขข้อมูลแบบคำขอรับบริการประเมิน TTRS (Mini TBP) <a href="'.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'" class="btn btn-sm bg-success">ตรวจสอบ</a>' ; 
            $alertmessage->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();

            EmailBox::send($_user->email,'TTRS:แก้ไขข้อมูลแบบคำขอรับบริการประเมิน TTRS (Mini TBP)','เรียนผู้ประกอบการ<br><br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านยังไม่ได้รับการอนุมัติ โปรดเข้าสู่ระบบเพื่อทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br>' .$request->note.  ' <br><a href="'.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'" class="btn btn-sm bg-success">ตรวจสอบ</a><br><br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('แก้ไขข้อมูลแบบคำขอรับบริการประเมิน TTRS (Mini TBP)','เรียนผู้ประกอบการ<br> แบบคำขอรับบริการประเมิน TTRS (Mini TBP) ของท่านยังไม่ได้รับการอนุมัติ โปรดทำการแก้ไขตามข้อแนะนำ ดังนี้<br><br>' .$request->note. '  <br><a href="'.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'" class="btn btn-sm bg-success">ตรวจสอบ</a><br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
        }

        return response()->json($minitbp); 
    }
}
