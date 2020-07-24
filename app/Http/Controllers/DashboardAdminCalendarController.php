<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Google_Client;
use App\Model\FullTbp;
use App\Helper\EmailBox;
use App\Model\EventCalendar;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Helper\GoogleCalendar;
use Google_Service_Calendar_Event;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCalendarRequest;


class DashboardAdminCalendarController extends Controller
{
    public function Index(){
        // $events = GoogleCalendar::get();
        // $_events = array();
        // if (!Empty($events)) {
        //     foreach ($events as $event) {
        //         if (count($event->attendees) > 0) {
        //             foreach ($event->attendees as $attendee) {
        //               if($attendee->email == Auth::user()->email){
        //                 $_events[] = array('start' => $event->start->dateTime, 'summary' => $event->getSummary(),'url' => $event->htmlLink);
        //                 break;
        //               }
        //             }
        //         }
        //     }
        // }
        // $myevents = collect($_events);
      $eventcalendars = EventCalendar::get();
      return view('dashboard.admin.calendar.index')->withEventcalendars($eventcalendars); 
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
        $fulltbps = FullTbp::get();
        $users = User::where('user_type_id','>=',3)->get();
        return view('dashboard.admin.calendar.create')->withUsers($users)
                                                    ->withFulltbps($fulltbps);
    }
    public function CreateSave(CreateCalendarRequest $request){
      $eventcalendar = new EventCalendar();
      $eventcalendar->full_tbp_id = $request->fulltbp;
      $eventcalendar->eventdate = DateConversion::thaiToEngDate($request->eventdate);
      $eventcalendar->starttime = $request->eventtimestart;
      $eventcalendar->endtime = $request->eventtimeend;
      $eventcalendar->place = $request->place;
      $eventcalendar->room = $request->room;
      $eventcalendar->summary = $request->summary;
      $eventcalendar->save();

      $mails = array();
      $joinusers = array();
      foreach($request->users as $user){
          $_user = User::find($user);
          $joinusers[] = $_user->name . ' ' . $_user->lastname;
          $mails[] = $_user->email;
          $eventcalendarattendee = new EventCalendarAttendee();
          $eventcalendarattendee->event_calendar_id = $eventcalendar->id;
          $eventcalendarattendee->user_id = $_user->id;
          $eventcalendarattendee->save();
      }
      EmailBox::send($mails,'TTRS:นัดหมายการประชุม','เรียนท่านคณะกรรมการ <br> โปรดเข้าร่วมประชุมนัดหมายระบบ TTRS มีรายละเอียดดังนี้' .
      '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
      '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
      '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
      '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
      '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
      '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
      '<br><br>ด้วยความนับถือ<br>TTRS');

      return redirect()->route('dashboard.admin.calendar')->withSuccess('เพิ่มรายการสำเร็จ');
  }
  public function Edit($id){
    $eventcalendar = EventCalendar::find($id);
    $eventcalendarattendees = EventCalendarAttendee::where('event_calendar_id',$eventcalendar->id)->get();
    $users = User::where('user_type_id','>=',3)->get();
    return view('dashboard.admin.calendar.edit')->withUsers($users)
                                                ->withEventcalendar($eventcalendar)
                                                ->withEventcalendarattendees($eventcalendarattendees);
  }
  public function EditSave(Request $request,$id){
    $unique_array  = Array();
    $comming_array  = Array();
    $removeguest_array  = Array();
    $newguest_array  = Array();
    $updateguest_array  = Array();
    foreach( $request->users as $key => $user ){
        $_user = User::find($user);
        $comming_array[] = $_user->id;
    }
    $removeguest_array = EventCalendarAttendee::where('event_calendar_id',$request->id)->whereNotIn('user_id',$comming_array)->pluck('user_id')->toArray();
    EventCalendarAttendee::where('event_calendar_id',$request->id)->whereNotIn('user_id',$comming_array)->delete();
    $existing_array = EventCalendarAttendee::where('event_calendar_id',$request->id)->pluck('user_id')->toArray();
    $unique_array = array_diff($comming_array, $existing_array);
    foreach($unique_array as $user){
        $_user = User::find($user);
        $newguest_array[] = $_user->id;
        $eventcalendar = new EventCalendarAttendee();
        $eventcalendar->event_calendar_id = $request->id;
        $eventcalendar->user_id =  $_user->id;
        $eventcalendar->save();
    }

    $updateguest_array = array_merge($existing_array,$newguest_array);

    EventCalendar::find($id)->update([
      'eventdate' => DateConversion::thaiToEngDate($request->eventdate),
      'starttime' => $request->eventtimestart,
      'endtime' => $request->eventtimeend,
      'place' => $request->place,
      'room' => $request->room,
      'summary' => $request->summary,
    ]);

    $mails = array();
    $joinusers = array();
    foreach($updateguest_array as $user){
        $_user = User::find($user);
        $joinusers[] = $_user->name . ' ' . $_user->lastname;
        $mails[] = $_user->email;
    }

    EmailBox::send($mails,'TTRS:นัดหมายการประชุม(แก้ไข)','เรียนท่านคณะกรรมการ <br> โปรดเข้าร่วมประชุมนัดหมายระบบ TTRS มีรายละเอียดดังนี้' .
    '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
    '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
    '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
    '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
    '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
    '<br><br>ด้วยความนับถือ<br>TTRS');

    $mails = array();
    foreach($removeguest_array as $user){
        $_user = User::find($user);
        $mails[] = $_user->email;
    }

    EmailBox::send($mails,'TTRS:ยกเลิก นัดหมายการประชุม','เรียนท่านคณะกรรมการ <br> โปรดทราบว่าการนัดหมายดังรายการได้ <span style="color:red">ยกเลิก</span>  ' .
    '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
    '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
    '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
    '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
    '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
    '<br><br>ด้วยความนับถือ<br>TTRS');
    return redirect()->route('dashboard.admin.calendar')->withSuccess('แก้ไขรายการสำเร็จ');
  }
  public function Delete($id){
    $eventcalendar = EventCalendar::find($id);
    $eventcalendars = Array();
    $eventcalendars = EventCalendarAttendee::where('event_calendar_id',$id)->pluck('user_id')->toArray();
    $mails = array();
    foreach($eventcalendars as $user){
        $_user = User::find($user);
        $mails[] = $_user->email;
    }

    EmailBox::send($mails,'TTRS:ยกเลิก นัดหมายการประชุม','เรียนท่านคณะกรรมการทุกท่าน <br> โปรดทราบว่าการนัดหมายดังรายการได้ <span style="color:red">ยกเลิก</span>  ' .
    '<br><br><strong>&nbsp;วันที่:</strong> '.DateConversion::engToThaiDate($eventcalendar->eventdate).
    '<br><strong>&nbsp;เวลา:</strong> '.$eventcalendar->eventtimestart. ' - ' . $eventcalendar->eventtimeend .
    '<br><strong>&nbsp;ห้อง:</strong> '.$eventcalendar->room.
    '<br><strong>&nbsp;รายละเอียด:</strong> '.$eventcalendar->summary.
    '<br><strong>&nbsp;สถานที่:</strong> '.$eventcalendar->place.
    '<br><br>ด้วยความนับถือ<br>TTRS');
    $eventcalendar->delete();
    return redirect()->route('dashboard.admin.calendar')->withSuccess('ลบการสำเร็จ');

  }
}
