<?php

namespace App\Console\Commands;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\Page;
use App\Model\Pillar;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Scoring;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\MeetingDate;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ExtraScoring;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use App\Model\ScoringStatus;
use App\Helper\DateConversion;
use Illuminate\Console\Command;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Model\ProjectMemberBackup;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;

class CronSendmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:sendemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and send notification email every minute using cron job.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $meetingdates = MeetingDate::get();
        foreach ($meetingdates as $key => $meetingdate) {
            $eventcalendar = EventCalendar::find($meetingdate->event_calendar_id);
            $fulltbp = FullTbp::find($eventcalendar->full_tbp_id);
            $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);

            $eventcalendars = Array();
            $eventcalendars = EventCalendarAttendee::where('event_calendar_id',$eventcalendar->id)->pluck('user_id')->toArray();
            $mails = array();
            foreach($eventcalendars as $user){
                $_user = User::find($user);
                $mails[] = $_user->email;
            }

            $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            $company = Company::find($businessplan->company_id);
            $usermail = User::find($company->user_id)->email;
            $date = Carbon::parse($eventcalendar->eventdate)->subDays(7);
            if($date->isToday() == 1){
                EmailBox::send($mails,'','TTRS: แจ้งเตือนการนัดหมายครั้งที่ 1','เรียน คณะกรรมการ <br><br> ท่านมีรายการนัดหมายของโครงการ'.$minitbp->project.' วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' สถานที่: '.$eventcalendar->place.' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                if($eventcalendar->calendar_type_id == 2){
                    EmailBox::send($usermail,'','TTRS: แจ้งเตือนเข้าประเมิน','เรียน ผู้ขอรับการประเมิน <br><br> โครงการ'.$minitbp->project.' มีนัดประเมิน วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                }
            }

            $date = Carbon::parse($eventcalendar->eventdate)->subDays(2);
            if($date->isToday() == 1){
                EmailBox::send($mails,'','TTRS: แจ้งเตือนการนัดหมายครั้งที่ 2','เรียน คณะกรรมการ <br><br> ท่านมีรายการนัดหมายของโครงการ'.$minitbp->project.' วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' สถานที่: '.$eventcalendar->place.' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                if($eventcalendar->calendar_type_id == 2){
                    EmailBox::send($usermail,'','TTRS: แจ้งเตือนเข้าประเมิน','เรียน ผู้ขอรับการประเมิน <br><br> โครงการ'.$minitbp->project.' มีนัดประเมิน วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                }
            }

            if($eventcalendar->calendar_type_id == 3){ //นัดหมายการลงคะแนน
                $ev = Ev::where('full_tbp_id',$eventcalendar->full_tbp_id)->first();
                $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
                $projectmembers = ProjectMember::whereNotIn('user_id',$scoringstatuses)->pluck('user_id')->toArray();
                $date = Carbon::parse($eventcalendar->eventdate)->subDays(2);
                if($date->isToday() == 1){
                    if(count($projectmembers) > 0){
                        $membermails = array();
                        foreach($projectmembers as $user){
                            $_user = User::find($user);
                            $membermails[] = $_user->email;
                        }
                        EmailBox::send($membermails,'','TTRS: แจ้งเตือนการสรุปคะแนน','เรียน คณะกรรมการ <br><br> ท่านยังไม่ได้ลงคะแนนการประเมิน ของโครงการ'.$minitbp->project.' กรุณาลงคะแนนก่อน วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                    }
                    $fulltbp = FullTbp::find($eventcalendar->full_tbp_id);
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
                    
                    $projectmembers = ProjectMember::whereNotIn('full_tbp_id',$eventcalendar->full_tbp_id)->pluck('user_id')->toArray();
                    $auth = Auth::user();
                    foreach ($projectmembers as $key => $user) {
                        $_user = User::find($user);
                        $notificationbubble = new NotificationBubble();
                        $notificationbubble->business_plan_id = $businessplan->id;
                        $notificationbubble->notification_category_id = 3;
                        $notificationbubble->notification_sub_category_id = 9;
                        $notificationbubble->user_id = $auth->id;
                        $notificationbubble->target_user_id = $_user->id;
                        $notificationbubble->save();
                
                        $messagebox = Message::sendMessage('แจ้งเตือนการสรุปคะแนน โครงการ' . $minitbp->project . $fullcompanyname ,'แจ้งเตือนการสรุปคะแนน โครงการ' . $minitbp->project . $fullcompanyname . ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.assessment').'>ดำเนินการ</a>',$auth->id,$_user->id);
                        
                        $alertmessage = new AlertMessage();
                        $alertmessage->user_id = $auth->id;
                        $alertmessage->target_user_id = $projectassignment->leader_id;
                        $alertmessage->messagebox_id = $messagebox->id;
                        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().  'แจ้งเตือนการสรุปคะแนน โครงการ' . $minitbp->project . $fullcompanyname . ' โปรดตรวจสอบ <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.assessment').'>ดำเนินการ</a>' ;
                        $alertmessage->save();
                
                        MessageBox::find($messagebox->id)->update([
                            'alertmessage_id' => $alertmessage->id
                        ]);
                    }
                }
            }
        } 
        $eventcalendars = EventCalendar::whereNotNull('eventdate')
                        ->whereNotNull('starttime')
                        ->whereNotNull('endtime')
                        ->whereNotNull('place')
                        ->whereNotNull('summary')
                        ->get();

        foreach ($eventcalendars as $key => $eventcalendar) {
            if($eventcalendar->calendar_type_id == 3){
                $ev = Ev::where('full_tbp_id',$eventcalendar->full_tbp_id)->first();
                $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
                $date = Carbon::parse($eventcalendar->eventdate);
                if($date->isToday() == 1){
                    if (count($scoringstatuses) <= 1) {
                        $scoringstatus = ScoringStatus::where('ev_id',$ev->id)->first();
                       
                        ScoringStatus::where('ev_id',$ev->id)->delete();
                        Scoring::where('ev_id',$ev->id)->delete();

                        ExtraScoring::where('ev_id',$ev->id)->delete();
                        
                        $_projectmembers = ProjectMember::where('full_tbp_id',$eventcalendar->full_tbp_id)->get();
                        foreach ($_projectmembers as $key => $_projectmember) {
                            $new = new ProjectMemberBackup();
                            $new->full_tbp_id = $_projectmember->full_tbp_id;
                            $new->user_id = $_projectmember->user_id;
                            $new->save(); 
                        }

                        ProjectMember::where('full_tbp_id',$eventcalendar->full_tbp_id)->delete();

                        $fulltbp = FullTbp::find($eventcalendar->full_tbp_id);
                        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
                        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
                        $company = Company::find($businessplan->company_id);
                
                        $company_name = (!Empty($company->name))?$company->name:'';
                        $bussinesstype = $company->business_type_id;
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

                        if (count($scoringstatuses) != 0){
                            $user = User::find($scoringstatus->user_id);
                            EmailBox::send($user->email,'','TTRS: แจ้งเตือนไม่สามารถสรุปคะแนนการประเมิน โครงการ'. $minitbp->project .$fullcompanyname,'เรียน คุณ '.$user->name .' ' . $user->lastname.' <br><br> แจ้งเตือนไม่สามารถสรุปคะแนนการประเมิน โครงการ'. $minitbp->project .$fullcompanyname.' เนื่องจากมีท่านเป็นผู้ลงคะแนนเพียงคนเดียว จึงแจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());    
                        }
                       
                    }
                    ProjectMember::whereNotIn('user_id',$scoringstatuses)->where('full_tbp_id',$eventcalendar->full_tbp_id)->delete();
                    $check = Scoring::where('ev_id',$ev->id)
                                    ->whereNull('user_id')
                                    ->get(); 
                    if($check->count() == 0){
                        $checkscoring = Scoring::where('ev_id',$ev->id)
                                ->whereNotNull('user_id')
                                ->first(); 
                        if(!Empty($checkscoring)){    
                            $scorings = Scoring::where('ev_id',$ev->id)
                                ->where('user_id',$checkscoring->user_id)
                                ->get(); 
                            foreach ($scorings as $key => $scoring) {
                                $new = new Scoring();
                                $new->ev_id = $scoring->ev_id;
                                $new->criteria_transaction_id  = $scoring->criteria_transaction_id ;
                                $new->sub_pillar_index_id = $scoring->sub_pillar_index_id;
                                $new->scoretype = $scoring->scoretype;
                                $new->score = $scoring->score;
                                $new->save();
                            } 
                            $fulltbp = FullTbp::find($eventcalendar->full_tbp_id)->update([
                                'done_assessment' => 1
                            ]); 
                        }        
                    }         
                }
            }
        }                
        // foreach ($eventcalendars as $key => $eventcalendar) {
        //     if($eventcalendar->calendar_type_id == 3){
        //         $ev = Ev::where('full_tbp_id',$eventcalendar->full_tbp_id)->first();
        //         $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
        //         $date = Carbon::parse($eventcalendar->eventdate);
        //         if($date->isToday() == 1){
        //             if (count($scoringstatuses) == 0) {
        //                 $_projectmembers = ProjectMember::where('full_tbp_id',$eventcalendar->full_tbp_id)->get();
        //                 foreach ($_projectmembers as $key => $_projectmember) {
        //                     $new = new ProjectMemberBackup();
        //                     $new->full_tbp_id = $_projectmember->full_tbp_id;
        //                     $new->user_id = $_projectmember->user_id;
        //                     $new->save(); 
        //                 }
        //             }
        //             ProjectMember::whereNotIn('user_id',$scoringstatuses)->where('full_tbp_id',$eventcalendar->full_tbp_id)->delete();
        //             $check = Scoring::where('ev_id',$ev->id)
        //                             ->whereNull('user_id')
        //                             ->get(); 
        //             if($check->count() == 0){
        //                 $user = Scoring::where('ev_id',$ev->id)
        //                         ->whereNotNull('user_id')
        //                         ->first(); 
        //                 if(!Empty($user)){
        //                     $scorings = Scoring::where('ev_id',$ev->id)
        //                             ->where('user_id',$user->id)
        //                             ->get(); 
        //                     foreach ($scorings as $key => $scoring) {
        //                         $_check = Scoring::where('ev_id',$scoring->ev_id)
        //                                     ->where('criteria_transaction_id',$scoring->criteria_transaction_id)
        //                                     ->where('sub_pillar_index_id',$scoring->sub_pillar_index_id)
        //                                     ->where('scoretype',$scoring->scoretype)
        //                                     ->whereNull('user_id')
        //                                     ->where('score',$scoring->score)->first();
        //                         if(Empty($_check)){
        //                             $new = new Scoring();
        //                             $new->ev_id = $scoring->ev_id;
        //                             $new->criteria_transaction_id  = $scoring->criteria_transaction_id ;
        //                             $new->sub_pillar_index_id = $scoring->sub_pillar_index_id;
        //                             $new->scoretype = $scoring->scoretype;
        //                             $new->score = $scoring->score;
        //                             $new->save();
        //                         }            
        //                     } 
        //                     $fulltbp = FullTbp::find($eventcalendar->full_tbp_id)->update([
        //                         'done_assessment' => 1
        //                     ]); 
        //                 }
        
        //             }
        //         }
        //     }
        // }
        $this->DailyFlowCheck();

    }

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
                }else{
                    // return $left . " days remains .So no need send mail out";
                }
            }else{
                // return 'not found';
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

}
