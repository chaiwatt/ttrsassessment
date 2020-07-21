<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use App\Helper\GoogleCalendar;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\Auth;


class DashboardAdminCalendarController extends Controller
{
    public function Index(){
        $events = GoogleCalendar::get();
        $_events = array();
        if (!Empty($events)) {
            foreach ($events as $event) {
                if (count($event->attendees) > 0) {
                    foreach ($event->attendees as $attendee) {
                      if($attendee->email == Auth::user()->email){
                        $_events[] = array('start' => $event->start->dateTime, 'summary' => $event->getSummary(),'url' => $event->htmlLink);
                        break;
                      }
                    }
                }
            }
        }
        $myevents = collect($_events);
      return view('dashboard.admin.calendar.index')->withMyevents($myevents); 
    }

    public function Create(){
        $emails = array('programprc@gmail.com','edutechthai@gmail.com','joerocknpc@gmail.com');
        $attendees = [];
        foreach ($emails as $email) {
            $attendees[] = array('email' => $email);
        }

        $data = [
            'summary' => 'ประชุมผู้เชี่ยวชาญ TTRS โครงการฟาร์มอัจฉริยะ',
            'location' => 'สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)',
            'description' => 'ประชุม TTRS โครงการฟาร์มอัจฉริยะ ณ ห้องประชุม 3 สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)',
            'startdate' =>  Carbon::now(),
            'enddate' => Carbon::now()->addHour(2),
            'attendees' => $attendees
            ];
        $events = GoogleCalendar::add($data);
        
        return redirect()->route('dashboard.admin.calendar');
    }
}
