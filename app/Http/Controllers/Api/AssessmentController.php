<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\FullTbpCost;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\FullTbpAsset;
use App\Model\FullTbpGantt;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Model\FullTbpEmployee;
use App\Model\TimeLineHistory;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpSellStatus;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Helper\ThaiNumericConverter;
use App\Http\Controllers\Controller;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectCertify;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
use App\Model\FullTbpReturnOfInvestment;
use App\Model\BusinessPlanFeeTransaction;

class AssessmentController extends Controller
{
    public function Add(Request $request){
        $auth = Auth::user();
        $businessplan = BusinessPlan::where('company_id',$request->companyid)->first();
        if(Empty($businessplan)){
            if($request->status == 1){
                $count = BusinessPlan::get()->count() + 1;
                $businessplan = new BusinessPlan();
                $businessplan->code = Carbon::now()->format('y') . Carbon::now()->format('m') . str_pad(($count),3,0,STR_PAD_LEFT); 
                $businessplan->company_id = $request->companyid;
                $businessplan->business_plan_status_id = 1;
                $businessplan->save();

                $minitbp = new MiniTBP();
                $minitbp->business_plan_id = $businessplan->id;
                $minitbp->save();

                $fulltbp = new FullTbp();
                $fulltbp->mini_tbp_id = $minitbp->id;
                $fulltbp->save();

                $fulltbpgantt = new FullTbpGantt();
                $fulltbpgantt->full_tbp_id = $fulltbp->id;
                $fulltbpgantt->startyear = intval(Carbon::now()->year) + 543 ;
                $fulltbpgantt->save();

                $fulltbpemployee = new FullTbpEmployee();
                $fulltbpemployee->full_tbp_id = $fulltbp->id;
                $fulltbpemployee->save();

                $fulltbpcompanyprofile = new FullTbpCompanyProfile();
                $fulltbpcompanyprofile->full_tbp_id = $fulltbp->id;
                $fulltbpcompanyprofile->save();

                $fulltbpprojectcertify = new FullTbpProjectCertify();
                $fulltbpprojectcertify->full_tbp_id = $fulltbp->id;
                $fulltbpprojectcertify->save();

                $notificationbubble = new NotificationBubble();
                $notificationbubble->business_plan_id = $businessplan->id;
                $notificationbubble->notification_category_id = 1;
                $notificationbubble->notification_sub_category_id = 2;
                $notificationbubble->user_id = $auth->id;
                $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
                $notificationbubble->save();
                
                $sellstatus = array("1. ยอดขายในประเทศ", "2. ยอดขายส่งออก", "  -  ยอดขายเปิด L/C (Letter of Credit) กับสถาบันการเงิน","  -  วงเงินตามสัญญา L/C ที่มีกับสถาบันการเงิน");

                foreach ($sellstatus as $status) {
                    FullTbpSellStatus::create([
                        'full_tbp_id' => $fulltbp->id,
                        'name' => $status
                    ]);
                }
                $assets = array("ค่าที่ดิน", "ค่าอาคารและสิ่งปลูกสร้าง", "ค่าตกแต่งอาคารและสิ่งปลูกสร้าง","ค่าเครื่องจักร","ค่าคอมพิวเตอร์","อื่นๆ");
                foreach ($assets as $asset) {
                    FullTbpAsset::create([
                        'full_tbp_id' => $fulltbp->id,
                        'asset' => $asset
                    ]);
                }
                $investments = array("ค่าใช้จ่ายในการจัดตั้งธุรกิจ (กรณีเพิ่งเริ่มจัดตั้งธุรกิจ)", "ค่าใช้จ่ายในการพัฒนาเทคโนโลยีหลักที่ใช้ในกระบวนการผลิตและบริการ", "ค่าใช้จ่ายในกระบวนการผลิต (เช่น ค่าวัตถุดิบ, ค่าแรง, ค่าใช้จ่ายในการผลิต)","ค่าใช้จ่ายในการดำเนินงาน","ค่าใช้จ่ายอื่นๆ");
                foreach ($investments as $investment) {
                    FullTbpInvestment::create([
                        'full_tbp_id' => $fulltbp->id,
                        'investment' => $investment
                    ]);
                }

                $costs = array("แหล่งเงินทุนภายใน", "แหล่งเงินทุนภายนอก");
                foreach ($costs as $cost) {
                    FullTbpCost::create([
                        'full_tbp_id' => $fulltbp->id,
                        'costname' => $cost
                    ]);
                }

                $fulltbpreturnofinvestment = new FullTbpReturnOfInvestment();
                $fulltbpreturnofinvestment->full_tbp_id = $fulltbp->id;
                $fulltbpreturnofinvestment->save();

                // $messagebox = new MessageBox();
                // $messagebox->title = 'ขอรับการประเมินใหม่';
                // $messagebox->message_priority_id = 1;
                // $messagebox->body = Company::where('user_id',$auth->id)->first()->name . 'ขอรับการประเมินใหม่';
                // $messagebox->sender_id = $auth->id;
                // $messagebox->receiver_id = User::where('user_type_id',6)->first()->id;
                // $messagebox->message_read_status_id = 1;
                // $messagebox->save();
                $messagebox =  Message::sendMessage('ขอรับการประเมินใหม่',' บริษัท'. $company->name . ' ได้สร้างรายการขอการประเมิน โปรดตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.businessplan.view',['id' => $businessplan->id]).'>คลิกที่นี่</a>',Auth::user()->id,User::where('user_type_id',6)->first()->id);

                $company = Company::where('user_id',Auth::user()->id);
                
                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = Company::where('user_id',$auth->id)->first()->name . 'ขอรับการประเมินใหม่ ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
                $alertmessage->save();

                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);
                
                EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:ขอรับการประเมินใหม่','เรียน Manager<br><br> บริษัท'. $company->name . ' ได้สร้างรายการขอการประเมิน โปรดตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.businessplan.view',['id' => $businessplan->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
               
            }
        }else{
            if($request->status == 1){
                $businessplan->where('company_id',$request->companyid)->first()->update([
                    'business_plan_active_status_id' => '1'
                ]);
            }else{
                $businessplan->where('company_id',$request->companyid)->first()->update([
                    'business_plan_active_status_id' => '2'
                ]);
            }
        }
        return response()->json($businessplan);  
    }

    public function LetterSent(Request $request){
        $minitbp = MiniTBP::find($request->id);
        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$request->id)->where('project_flow_id',7)->first();
        if($projectstatustransaction->status == 1){
            $projectstatustransaction->update([
                'status' => 2
            ]);
            $projectstatustransaction = new ProjectStatusTransaction();
            $projectstatustransaction->mini_tbp_id = $request->id;
            $projectstatustransaction->project_flow_id = 8;
            $projectstatustransaction->save();
            DateConversion::addExtraDay($request->id,7);

            ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',7)->first()->update([
                'actual_startdate' =>  Carbon::now()->toDateString()
            ]);

            $auth = Auth::user();
            $timeLinehistory = new TimeLineHistory();
            $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
            $timeLinehistory->details = 'TTRS: ยืนยันการส่งจดหมายแจ้งผล';
            $timeLinehistory->message_type = 3;
            $timeLinehistory->owner_id = $auth->id;
            $timeLinehistory->user_id = $auth->id;
            $timeLinehistory->save();
        }
       

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = Auth::user()->id;
        $projectlog->action = 'ยืนยันส่งจดหมายแจ้งผล';
        $projectlog->save();

        CreateUserLog::createLog('ยืนยันส่งจดหมายแจ้งผล โครงการ' . $minitbp->project);
    }

    public function NotifyResult(Request $request){
        $auth = Auth::user();
        $minitbp = MIniTBP::find($request->id);
        BusinessPlan::find($minitbp->business_plan_id)->update([
                'business_plan_status_id' => 9
            ]);
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
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
            $fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        foreach ($projectmembers as $key => $projectmember) {
            $_user = User::find($projectmember->user_id);
            $messagebox = Message::sendMessage('ยืนยันแจ้งผลการประเมิน โครงการ'.$minitbp->project .' ของ' . $fullcompanyname,'ยืนยันแจ้งผลการประเมิน โครงการ'.$minitbp->project . ' ของ' . $fullcompanyname.' เสร็จเรียบร้อยแล้ว',$auth->id,$projectmember->user_id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $projectmember->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' ยืนยันแจ้งผลการประเมิน โครงการ'.$minitbp->project .' เสร็จเรียบร้อยแล้ว';
            $alertmessage->save();
    
            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
            EmailBox::send($_user->email,'TTRS:ยืนยันแจ้งผลการประเมิน โครงการ'.$minitbp->project  .' ของ' . $fullcompanyname,'เรียน ทีมประเมิน <br><br> LEADER ยืนยันแจ้งผลการประเมิน โครงการ'.$minitbp->project.' เสร็จเรียบร้อยแล้ว <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }


        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',6)->first();
        if($projectstatustransaction->status == 1){
            $projectstatustransaction->update([
                'status' => 2
            ]);
            $projectstatustransaction = new ProjectStatusTransaction();
            $projectstatustransaction->mini_tbp_id = $minitbp->id;
            $projectstatustransaction->project_flow_id = 7;
            $projectstatustransaction->save();

            ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',6)->first()->update([
                'actual_startdate' =>  Carbon::now()->toDateString()
            ]);

            $mailbody  ="เรียน คุณ".$fulltbp->fulltbpresponsibleperson->name ." ".$fulltbp->fulltbpresponsibleperson->lastname . " กรรมการผู้จัดการ บริษัท ". $fulltbp->minitbp->businessplan->company->name ."<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ท่านได้แจ้งความประสงค์เข้ารับบริการประเมินศักยภาพผู้ประกอบการโดย TTRS Model โครงการเลขที่ " . ThaiNumericConverter::toThaiNumeric($fulltbp->minitbp->businessplan->code) . " เรื่อง" .$fulltbp->minitbp->project ." ของ บริษัท" . $fulltbp->minitbp->businessplan->company->name . " ความละเอียดทราบแล้วนั้น บัดนี้ สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.) โดยศูนย์สนับสนุนและให้บริการประเมินจัดอันดับเทคโนโลยีของประเทศบริการประเมินจัดอันดับเทคโนโลยีของประเทศ (TTRS) ได้ทำการประเมินเสร็จสิ้นเป็นที่เรียบร้อยแล้ว จึงขอแจ้งผลการประเมินศักยภาพผู้ประกอบการโดย TTRS Model ซึ่งได้คะแนน " .ThaiNumericConverter::toThaiNumeric(number_format($fulltbp->projectgrade->percent, 2, '.', '')) . " คะแนน จากคะแนนเต็ม " .ThaiNumericConverter::toThaiNumeric('100') ." คะแนนคิดเป็นเกรดระดับ " . $fulltbp->projectgrade->grade ." โดยสำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ จะจัดส่งหนังสือแจ้งผลการประเมินอย่างเป็นทางการในลำดับถัดไป";
            EmailBox::send(User::find($company->user_id)->email,'TTRS:แจ้งผลการประเมินศักยภาพผู้ประกอบการโดย TTRS Model โครงการ' . $minitbp->project,$mailbody.'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            DateConversion::addExtraDay($minitbp->id,6);
        } 

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'ยืนยันแจ้งผลการประเมิน';
        $projectlog->save();

        CreateUserLog::createLog('ยืนยันแจ้งผลการประเมิน โครงการ' . $minitbp->project);
    }
}
