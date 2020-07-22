<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use App\Helper\GoogleCalendar;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCalendarRequest;


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

        // $_date = '2020-07-22';
        // $_time1 = '15:30:00';
        // $_time2 = '16:30:00';
        // $emails = array('programprc@gmail.com','edutechthai@gmail.com','joerocknpc@gmail.com');
        // $attendees = [];
        // foreach ($emails as $email) {
        //     $attendees[] = array('email' => $email);
        // }
        // $data = [
        //     'summary' => 'ประชุมผู้เชี่ยวชาญ TTRS โครงการฟาร์มอัจฉริยะ',
        //     'location' => 'สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)',
        //     'description' => 'ประชุม TTRS โครงการฟาร์มอัจฉริยะ ณ ห้องประชุม 3 สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)',
        //     'startdate' =>  Carbon::createFromFormat('Y-m-d H:i:s', $_date.' '.$_time1),
        //     'enddate' => Carbon::createFromFormat('Y-m-d H:i:s', $_date.' '.$_time2),
        //     'attendees' => $attendees
        //     ];
        // $event = GoogleCalendar::add($data);
        // return 'new event id: ' . $event->id;
        $users = User::where('user_type_id','>=',3)->get();
        return view('dashboard.admin.calendar.create')->withUsers($users);
    }
    public function CreateSave(CreateCalendarRequest $request){
      return 'ok';
      // $_date = '2020-07-22';
      // $_time1 = '15:30:00';
      // $_time2 = '16:30:00';
      // $emails = array('programprc@gmail.com','edutechthai@gmail.com','joerocknpc@gmail.com');
      // $attendees = [];
      // foreach ($emails as $email) {
      //     $attendees[] = array('email' => $email);
      // }
      // $data = [
      //     'summary' => 'ประชุมผู้เชี่ยวชาญ TTRS โครงการฟาร์มอัจฉริยะ',
      //     'location' => 'สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)',
      //     'description' => 'ประชุม TTRS โครงการฟาร์มอัจฉริยะ ณ ห้องประชุม 3 สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)',
      //     'startdate' =>  Carbon::createFromFormat('Y-m-d H:i:s', $_date.' '.$_time1),
      //     'enddate' => Carbon::createFromFormat('Y-m-d H:i:s', $_date.' '.$_time2),
      //     'attendees' => $attendees
      //     ];
      // $event = GoogleCalendar::add($data);
      // return 'new event id: ' . $event->id;
      // $users = User::where('user_type_id','>=',3)->get();
      // return view('dashboard.admin.calendar.create')->withUsers($users);
  }
}
