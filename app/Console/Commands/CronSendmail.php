<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use App\Model\Pillar;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\EmailBox;
use App\Model\MeetingDate;
use App\Model\EventCalendar;
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
            $date = Carbon::parse($eventcalendar->eventdate)->subDays(7);
            if($date->isToday() == 1){
                $eventcalendar = EventCalendar::find($eventcalendar->id);
                $fulltbp = FullTbp::find($eventcalendar->full_tbp_id);
                $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
                $eventcalendars = Array();
                $eventcalendars = EventCalendarAttendee::where('event_calendar_id',$eventcalendar->id)->pluck('user_id')->toArray();
                $mails = array();
                foreach($eventcalendars as $user){
                    $_user = User::find($user);
                    $mails[] = $_user->email;
                }
                EmailBox::send($mails,'TTRS:แจ้งเตือนการประชุมครั้งที่ 1','เรียนท่านกรรมการ <br> ท่านมีรายการประชุมของโครงการ'.$minitbp->project.' วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' สถานที่: '.$eventcalendar->place.' แจ้งมาเพื่อทราบ<br>ด้วยความนับถือ<br>TTRS');
            }

            $date = Carbon::parse($eventcalendar->eventdate)->subDays(2);
            if($date->isToday() == 1){
                $eventcalendar = EventCalendar::find($eventcalendar->id);
                $fulltbp = FullTbp::find($eventcalendar->full_tbp_id);
                $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
                $eventcalendars = Array();
                $eventcalendars = EventCalendarAttendee::where('event_calendar_id',$eventcalendar->id)->pluck('user_id')->toArray();
                $mails = array();
                foreach($eventcalendars as $user){
                    $_user = User::find($user);
                    $mails[] = $_user->email;
                }
                EmailBox::send($mails,'TTRS:แจ้งเตือนการประชุมครั้งที่ 2','เรียนท่านกรรมการ <br> ท่านมีรายการประชุมของโครงการ'.$minitbp->project.' วันที่ '.DateConversion::engToThaiDate($eventcalendar->eventdate).' สถานที่: '.$eventcalendar->place.' แจ้งมาเพื่อทราบ<br>ด้วยความนับถือ<br>TTRS');
            }
        }       
    }
}
