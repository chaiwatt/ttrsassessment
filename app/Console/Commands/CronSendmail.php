<?php

namespace App\Console\Commands;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\Pillar;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Scoring;
use App\Helper\EmailBox;
use App\Model\MeetingDate;
use App\Model\BusinessPlan;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use App\Model\ScoringStatus;
use App\Helper\DateConversion;
use Illuminate\Console\Command;
use App\Model\EventCalendarAttendee;

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
                EmailBox::send($mails,'TTRS:แจ้งเตือนการนัดหมายครั้งที่ 1','เรียนท่านกรรมการ <br><br> ท่านมีรายการนัดหมายของโครงการ'.$minitbp->project.' วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' สถานที่: '.$eventcalendar->place.' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                if($eventcalendar->calendar_type_id == 2){
                    EmailBox::send($usermail,'TTRS:แจ้งเตือนเข้าประเมิน','เรียนผู้ขอรับการประเมิน <br><br> โครงการ'.$minitbp->project.' มีนัดประเมิน วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                }
            }

            $date = Carbon::parse($eventcalendar->eventdate)->subDays(2);
            if($date->isToday() == 1){
                EmailBox::send($mails,'TTRS:แจ้งเตือนการนัดหมายครั้งที่ 2','เรียนท่านกรรมการ <br><br> ท่านมีรายการนัดหมายของโครงการ'.$minitbp->project.' วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' สถานที่: '.$eventcalendar->place.' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                if($eventcalendar->calendar_type_id == 2){
                    EmailBox::send($usermail,'TTRS:แจ้งเตือนเข้าประเมิน','เรียนผู้ขอรับการประเมิน <br><br> โครงการ'.$minitbp->project.' มีนัดประเมิน วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
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
                        EmailBox::send($membermails,'TTRS:แจ้งเตือนลงคะแนนการประเมิน','เรียนท่านกรรมการ <br><br> ท่านยังไม่ได้ลงคะแนนการประเมิน ของโครงการ'.$minitbp->project.' กรุณาลงคะแนนก่อน วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' แจ้งมาเพื่อทราบ<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                    }
                }
            }
        } 
        $eventcalendars = EventCalendar::get();
        foreach ($eventcalendars as $key => $eventcalendar) {
            if($eventcalendar->calendar_type_id == 3){
                $ev = Ev::where('full_tbp_id',$eventcalendar->full_tbp_id)->first();
                $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
                $date = Carbon::parse($eventcalendar->eventdate);
                if($date->isToday() == 1){
                    ProjectMember::whereNotIn('user_id',$scoringstatuses)->where('full_tbp_id',$eventcalendar->full_tbp_id)->delete();
                    $check = Scoring::where('ev_id',$ev->id)
                                    ->whereNull('user_id')
                                    ->get(); 
                    if($check->count() == 0){
                        $userid = Scoring::where('ev_id',$ev->id)
                                ->whereNotNull('user_id')
                                ->first()->user_id; 
                        $scorings = Scoring::where('ev_id',$ev->id)
                                ->where('user_id',$userid)
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
}
