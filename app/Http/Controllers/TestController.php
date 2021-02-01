<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Helper\EmailBox;
use App\Model\BusinessPlan;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\ProjectAssignment;
use App\Model\ProjectStatusTransaction;

class TestController extends Controller
{
    public function DailyFlowCheck(){
        $minitbps = MiniTBP::get();
        foreach ($minitbps as $key => $minitbp) {
            $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('status',1)->orderBy('id','desc')->first();
            if(!Empty($projectstatustransaction)){
                $flow = $projectstatustransaction->project_flow_id;
                $projectstatus = ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',$flow)->first();
                $enddate = Carbon::createFromFormat('Y-m-d', $projectstatus->enddate);
                $left = Carbon::parse(Carbon::now())->DiffInDays($enddate, false);
                if ($left == 1){
                    $this->mailByFlow($minitbp->id,$flow,$enddate);
                    // return $left . " day remain. So, send email";
                    
                }else{
                    return $left . " days remains .So no need send mail out";
                }
            }else{
                return 'not found';
            }
        }
    }

    
    public function mailByFlow($minitbpid,$flow,$_enddate){
        $enddate = DateConversion::engToThaiDate($_enddate->format('Y-m-d'));
        $minitbp = MiniTBP::find($minitbpid);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $leader = User::find($projectassignment->leader_id);
        if($flow == 1){
            $jduser = User::where('user_type_id',6)->first();
            EmailBox::send($jduser->email,'TTRS:แจ้งเตือนใกล้ถึงกำหนดการมอบหมาย Leader และ Co-Leader สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน JD <br><br> แจ้งเตือนใกล้ถึงกำหนดการมอบหมาย Leader และ Co-Leader ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 2){
            EmailBox::send($leader->email,'TTRS:แจ้งเตือนใกล้ถึงกำหนดการอนุมัติ Mini TBP สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดการอนุมัติ Mini TBP ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 3){
            EmailBox::send($leader->email,'TTRS:แจ้งเตือนใกล้ถึงกำหนดการอนุมัติ Full TBP, การมอบหมายผู้เชี่ยวชาญ และการพัฒนา EV สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดการอนุมัติ Full TBP, การมอบหมายผู้เชี่ยวชาญ และการพัฒนา EV ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 4){
            EmailBox::send($leader->email,'TTRS:แจ้งเตือนใกล้ถึงกำหนดนัดหมายการประเมิน ณ สถานประกอบการ สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดนัดหมายการประเมิน ณ สถานประกอบการ ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 5){
            EmailBox::send($leader->email,'TTRS:แจ้งเตือนใกล้ถึงกำหนดการลงคะแนนและสรุปผล สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดการลงคะแนนและสรุปผล ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 6){
            EmailBox::send($leader->email,'TTRS:แจ้งเตือนการส่งผลการประเมินทาง Email สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนการส่งผลการประเมินทาง Email ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 7){
            EmailBox::send($leader->email,'TTRS:แจ้งเตือนใกล้ถึงกำหนดส่งจดหมายแจ้งผลทางการ และใบ CERTIFICATE สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดส่งจดหมายแจ้งผลทางการ และใบ CERTIFICATE ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 8){
            EmailBox::send($leader->email,'TTRS:แจ้งเตือนใกล้ถึงการระบุโครงการประเมินแล้วเสร็จสิ้น สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงการระบุโครงการประเมินแล้วเสร็จสิ้น ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }
    }
}
