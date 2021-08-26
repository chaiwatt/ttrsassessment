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
            EmailBox::send($jduser->email,'','TTRS: แจ้งเตือนใกล้ถึงกำหนดการมอบหมาย Leader และ Co-Leader สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Manager<br><br> แจ้งเตือนใกล้ถึงกำหนดการมอบหมาย Leader และ Co-Leader ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 2){
            EmailBox::send($leader->email,'','TTRS: แจ้งเตือนใกล้ถึงกำหนดการอนุมัติ Mini TBP สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดการอนุมัติ Mini TBP ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.'<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 3){
            EmailBox::send($leader->email,'','TTRS: แจ้งเตือนใกล้ถึงกำหนดการอนุมัติ Full TBP, การมอบหมายผู้เชี่ยวชาญ และการพัฒนา EV สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดการอนุมัติ Full TBP, การมอบหมายผู้เชี่ยวชาญ และการพัฒนา EV ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 4){
            EmailBox::send($leader->email,'','TTRS: แจ้งเตือนใกล้ถึงกำหนดนัดหมายการประเมิน ณ สถานประกอบการ สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดนัดหมายการประเมิน ณ สถานประกอบการ ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 5){
            EmailBox::send($leader->email,'','TTRS: แจ้งเตือนใกล้ถึงกำหนดการลงคะแนนและสรุปผล สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดการลงคะแนนและสรุปผล ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 6){
            EmailBox::send($leader->email,'','TTRS: แจ้งเตือนการส่งผลการประเมินทาง Email สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนการส่งผลการประเมินทาง Email ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 7){
            EmailBox::send($leader->email,'','TTRS: แจ้งเตือนใกล้ถึงกำหนดส่งจดหมายแจ้งผลทางการ และใบ CERTIFICATE สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงกำหนดส่งจดหมายแจ้งผลทางการ และใบ CERTIFICATE ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }else if($flow == 8){
            EmailBox::send($leader->email,'','TTRS: แจ้งเตือนใกล้ถึงการระบุโครงการประเมินแล้วเสร็จสิ้น สำหรับโครงการ'. $minitbp->project . ' บริษัท ' . $company->name,'เรียน Leader <br><br> แจ้งเตือนใกล้ถึงการระบุโครงการประเมินแล้วเสร็จสิ้น ของโครงการ'.$minitbp->project. ' บริษัท'.$company->name. ' ซึ่งจะครบกำหนดตาม Control Flow วันที่ '.$enddate.' <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        }
    }

    public function DemoJson(Request $request){
        $ganttdata = [
            ['key' => 1,'full_tbp_id' => 1, 'month' => 6],
            ['key' => 2,'full_tbp_id' => 1, 'month' => 7],
            ['key' => 3,'full_tbp_id' => 2, 'month' => 7],
            ['key' => 4,'full_tbp_id' => 2, 'month' => 8],
            ['key' => 5,'full_tbp_id' => 3, 'month' => 2],
            ['key' => 6,'full_tbp_id' => 3, 'month' => 4],
            ['key' => 7,'full_tbp_id' => 4, 'month' => 13],
            ['key' => 8,'full_tbp_id' => 4, 'month' => 14],
            ['key' => 9,'full_tbp_id' => 4, 'month' => 15],
            ['key' => 10,'full_tbp_id' => 4, 'month' => 16],
            ['key' => 11,'full_tbp_id' => 4, 'month' => 25],
            ['key' => 12,'full_tbp_id' => 5, 'month' => 26],
            ['key' => 13,'full_tbp_id' => 5, 'month' => 27],
            ['key' => 14,'full_tbp_id' => 5, 'month' => 28],
            ['key' => 15,'full_tbp_id' => 5, 'month' => 13],
            ['key' => 16,'full_tbp_id' => 5, 'month' => 14],
            ['key' => 17,'full_tbp_id' => 5, 'month' => 31],
          ];
          
        usort($ganttdata, array( $this, 'invenDescSort' ));

        $count = 1;
        $flag = false;
        foreach ($ganttdata as $key => $value){
            // echo  ('ลำดับ: '. $count . ' row: ' .  $ganttdata[$key]['full_tbp_id'] . ' month: ' . $ganttdata[$key]['month']) . '<br>';
            $count ++;
            if($key < count($ganttdata)-1){
                if($ganttdata[$key]['month'] == $ganttdata[$key+1]['month']){
                    $count --;
                }
            }
        }
        
        $arr = array();
        for ($k=0 ; $k<10 ; $k++){
            $arr[] = array('key' => $k , 'full_tbp_id' => $k*2 , 'month' => $k*3 ); 
        }
        $arrcollection = collect($arr);
        return $arrcollection;
    }

    public  function invenDescSort($item1,$item2)
    {
        if ($item1['month'] == $item2['month']) return 0;
        return ($item1['month'] > $item2['month']) ? 1 : -1;
    }

    public  function ccMail()
    {
        // if ($item1['month'] == $item2['month']) return 0;
        // return ($item1['month'] > $item2['month']) ? 1 : -1;
        // $mailto,$mailcc,$title,$message
        EmailBox::send('ttrsjd@npcsolution.com','ttrsadmin@npcsolution.com','ทดสอบการส่งเมล์และ cc','ทดสอบการส่งเมล์และ cc');
        return ;
    }
}
