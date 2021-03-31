<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Google_Client;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Model\Isnotify;
use App\Helper\EmailBox;
use App\Model\MeetingDate;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\CalendarType;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Helper\GoogleCalendar;
use App\Model\TimeLineHistory;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Google_Service_Calendar_Event;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCalendarRequest;


class DashboardAdminCalendarController extends Controller
{
    public function Index(){
      $auth = Auth::user();
      NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',2)
                        ->where('notification_sub_category_id',8)
                        ->where('status',0)->delete();
      $projectassignments = ProjectAssignment::where('leader_id',Auth::user()->id)->pluck('business_plan_id')->toArray();

      $minitbps = MiniTBP::whereIn('business_plan_id',$projectassignments)->pluck('id')->toArray();
      $fulltbps = FullTbp::whereIn('mini_tbp_id',$minitbps)->pluck('id')->toArray();
      $eventcalendars = EventCalendar::whereIn('full_tbp_id',$fulltbps)->where('status',1)->get();
      return view('dashboard.admin.calendar.index')->withEventcalendars($eventcalendars); 
    }

    public function Create(){
        $users = User::where('user_type_id','>=',3)->get();
        $calendartypes = CalendarType::get();
        $projectassignments = ProjectAssignment::where('leader_id',Auth::user()->id)->pluck('business_plan_id')->toArray();
        
        $minitbps = MiniTBP::whereIn('business_plan_id',$projectassignments)->pluck('id')->toArray();
        
        $fulltbps = FullTbp::whereIn('mini_tbp_id',$minitbps)->get();
        $isnotifies = Isnotify::get();
        return view('dashboard.admin.calendar.create')->withUsers($users)
                                                    ->withFulltbps($fulltbps)
                                                    ->withCalendartypes($calendartypes)
                                                    ->withIsnotifies($isnotifies);
    }
    public function CreateSave(CreateCalendarRequest $request){
      $auth = Auth::user();
      // $check = EventCalendar()->where('full_tbp_id',$request->fulltbp)
      $eventcalendar = new EventCalendar();
      $eventcalendar->full_tbp_id = $request->fulltbp;
      $eventcalendar->calendar_type_id = $request->calendartype;
      $eventcalendar->eventdate = DateConversion::thaiToEngDate($request->eventdate);
      $eventcalendar->starttime = $request->eventtimestart;
      $eventcalendar->endtime = $request->eventtimeend;
      $eventcalendar->place = $request->place;
      $eventcalendar->room = $request->room;
      $eventcalendar->summary = $request->summary;
      $eventcalendar->isnotify_id = $request->isnotify;
      $eventcalendar->save();

      if($request->isnotify == 2){
        $meetingdate = new MeetingDate();
        $meetingdate->event_calendar_id = $eventcalendar->id;
        $meetingdate->save();
      }

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
      $fulltbp = FullTbp::find($request->fulltbp);
      $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
      $businessplan = BusinessPlan::find($minitbp->business_plan_id);
      $company = Company::find($businessplan->company_id);

      $messageheader = "นัดหมายการประชุมและลงคะแนนการประเมิน โครงการ" . $minitbp->project . " บริษัท" . $company->name;
      if ($request->calendartype == 1) {
        $messageheader = "นัดหมายการประชุมและ briefing ก่อนการลงพื้นที่ประเมิน โครงการ" . $minitbp->project . " บริษัท" . $company->name;
      }else if ($request->calendartype == 1){
        $messageheader = "นัดหมายการประชุมและรายละเอียดการลงพื้นที่ประเมิน โครงการ" . $minitbp->project . " บริษัท" . $company->name;
      }
      EmailBox::send($mails,'TTRS:'.$messageheader,'เรียนท่านคณะกรรมการ <br><br> โปรดเข้าร่วมประชุมนัดหมายระบบ TTRS มีรายละเอียดดังนี้' .
      '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
      '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
      '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
      '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
      '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
      '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
      '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());


      foreach($request->users as $user){
          $_user = User::find($user);
          Message::sendMessage($messageheader,'เรียนท่านคณะกรรมการ <br><br> โปรดเข้าร่วมประชุมนัดหมายระบบ TTRS มีรายละเอียดดังนี้' .
          '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
          '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
          '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
          '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
          '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
          '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
          '<br><br>ด้วยความนับถือ<br>TTRS' ,Auth::user()->id,$_user->id);

          $alertmessage = new AlertMessage();
          $alertmessage->user_id = $auth->id;
          $alertmessage->target_user_id = $_user->id;
          $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' '. $messageheader. ' โครงการ'.$minitbp->project;
          $alertmessage->save();
    
          $notificationbubble = new NotificationBubble();
          $notificationbubble->business_plan_id = $minitbp->business_plan_id;
          $notificationbubble->notification_category_id = 2;
          $notificationbubble->notification_sub_category_id = 8;
          $notificationbubble->user_id = $auth->id;
          $notificationbubble->target_user_id = $_user->id;
          $notificationbubble->save();
      }

      if ($request->calendartype == 2) {
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $company->user_id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' นัดหมายเข้าประเมิน สำหรับโครงการ'.$minitbp->project;
        $alertmessage->save();
 
        EmailBox::send(User::find($company->user_id)->email,'TTRS:นัดหมายการประเมิน ณ สถานประกอบการ','เรียนผู้ขอรับการประเมิน <br><br> แจ้งนัดหมายการประเมิน ณ สถานประกอบการ มีรายละเอียดดังนี้' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
        '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
        '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
        '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
        $timeLinehistory->details = 'นัดหมายการประเมิน ณ สถานประกอบการ';
        $timeLinehistory->message_type = 2;
        $timeLinehistory->owner_id = $company->user_id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();
      }else if($request->calendartype == 3) {
        BusinessPlan::find($minitbp->business_plan_id)->update([
          'business_plan_status_id' => 7
        ]);

        $projectmembers = ProjectMember::where('full_tbp_id',$request->fulltbp)->get();
        
        foreach ($projectmembers as $key => $projectmember) {
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 7;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $projectmember->user_id;
            $notificationbubble->save();
        }
      }

      CreateUserLog::createLog('สร้างปฎิทินกิจกรรม ' . $messageheader );
      return redirect()->route('dashboard.admin.calendar')->withSuccess('เพิ่มรายการสำเร็จ');
  }
  public function Edit($id){
    $calendartypes = CalendarType::get();
    $eventcalendar = EventCalendar::find($id);
    $eventcalendarattendees = EventCalendarAttendee::where('event_calendar_id',$eventcalendar->id)->get();
    $users = User::where('user_type_id','>=',3)->get();
    $isnotifies = Isnotify::get();
    return view('dashboard.admin.calendar.edit')->withUsers($users)
                                                ->withEventcalendar($eventcalendar)
                                                ->withEventcalendarattendees($eventcalendarattendees)
                                                ->withCalendartypes($calendartypes)
                                                ->withIsnotifies($isnotifies);
  }
  public function EditSave(Request $request,$id){
    $auth = Auth::user();
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
    
    $eventcalendar = EventCalendar::find($id);
    if($eventcalendar->isnotify_id == 1 && $request->isnotify == 2){
      $check = MeetingDate::where('event_calendar_id',$request->id)->first();
      if(Empty($check)){
        $meetingdate = new MeetingDate();
        $meetingdate->event_calendar_id = $eventcalendar->id;
        $meetingdate->save();
      }
      $eventcalendar->update(['isnotify_id' => $request->isnotify]);
    }

    $fulltbp = FullTbp::find(EventCalendar::find($id)->full_tbp_id);
    $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
    $mails = array();
    $joinusers = array();
    foreach($updateguest_array as $user){
        $_user = User::find($user);
        $joinusers[] = $_user->name . ' ' . $_user->lastname;
        $mails[] = $_user->email;
    }
 
    EmailBox::send($mails,'TTRS:นัดหมายการประชุม(แก้ไข)','เรียนท่านคณะกรรมการ <br><br> โปรดเข้าร่วมประชุมนัดหมายระบบ TTRS มีรายละเอียดดังนี้' .
    '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
    '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
    '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
    '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
    '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
    '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
    '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

    foreach($updateguest_array as $user){
        $_user = User::find($user);

        Message::sendMessage('นัดหมายการประชุม','TTRS:นัดหมายการประชุม(แก้ไข) เรียนท่านคณะกรรมการ <br><br>โปรดเข้าร่วมประชุมนัดหมายระบบ TTRS มีรายละเอียดดังนี้' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
        '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
        '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
        '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
        '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
        '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
        '<br><br>ด้วยความนับถือ<br>TTRS' ,Auth::user()->id,$_user->id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $_user->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' นัดหมายการประชุม (แก้ไข)สำหรับโครงการ'.$minitbp->project.' ' ;
        $alertmessage->save();
  
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $minitbp->business_plan_id;
        $notificationbubble->notification_category_id = 2;
        $notificationbubble->notification_sub_category_id = 8;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $_user->id;
        $notificationbubble->save();
    }

    $mails = array();
    foreach($removeguest_array as $user){
        $_user = User::find($user);
        $mails[] = $_user->email;
    }

    if ($mails > 0){
        EmailBox::send($mails,'TTRS:ยกเลิก นัดหมายการประชุม','เรียนท่านคณะกรรมการ <br><br>โปรดทราบว่าการนัดหมายดังรายการได้ <span style="color:red">ยกเลิก</span>  ' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
        '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
        '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
        '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
        '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
        '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
    
        foreach($removeguest_array as $user){
            $_user = User::find($user);
            Message::sendMessage('ยกเลิก นัดหมายการประชุม','เรียนท่านคณะกรรมการ <br><br>โปรดทราบว่าการนัดหมายดังรายการได้ <span style="color:red">ยกเลิก</span>  ' .
            '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
            '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
            '<br><strong>&nbsp;ห้อง:</strong> '.$request->room.
            '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
            '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
            '<br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
        }
    
    }
    CreateUserLog::createLog('แก้ไขปฎิทินกิจกรรม โครงการ' . $minitbp->project );
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

    EmailBox::send($mails,'TTRS:ยกเลิก นัดหมายการประชุม','เรียนท่านคณะกรรมการทุกท่าน <br><br>โปรดทราบว่าการนัดหมายดังรายการได้ <span style="color:red">ยกเลิก</span>  ' .
    '<br><br><strong>&nbsp;วันที่:</strong> '.DateConversion::engToThaiDate($eventcalendar->eventdate).
    '<br><strong>&nbsp;เวลา:</strong> '.$eventcalendar->eventtimestart. ' - ' . $eventcalendar->eventtimeend .
    '<br><strong>&nbsp;ห้อง:</strong> '.$eventcalendar->room.
    '<br><strong>&nbsp;รายละเอียด:</strong> '.$eventcalendar->summary.
    '<br><strong>&nbsp;สถานที่:</strong> '.$eventcalendar->place.
    '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
    $eventcalendar->delete();
    foreach($eventcalendars as $user){
        $_user = User::find($user);
        Message::sendMessage('ยกเลิก นัดหมายการประชุม','เรียนท่านคณะกรรมการทุกท่าน <br><br>โปรดทราบว่าการนัดหมายดังรายการได้ <span style="color:red">ยกเลิก</span>  ' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.DateConversion::engToThaiDate($eventcalendar->eventdate).
        '<br><strong>&nbsp;เวลา:</strong> '.$eventcalendar->eventtimestart. ' - ' . $eventcalendar->eventtimeend .
        '<br><strong>&nbsp;ห้อง:</strong> '.$eventcalendar->room.
        '<br><strong>&nbsp;รายละเอียด:</strong> '.$eventcalendar->summary.
        '<br><strong>&nbsp;สถานที่:</strong> '.$eventcalendar->place.
        '<br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
    }
    CreateUserLog::createLog('ลบปฎิทินกิจกรรม');
    return redirect()->route('dashboard.admin.calendar')->withSuccess('ลบการสำเร็จ');

  }
}
