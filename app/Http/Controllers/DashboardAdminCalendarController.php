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
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\MeetingDate;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\CalendarType;
use App\Model\ExpertDetail;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Helper\GoogleCalendar;
use App\Model\TimeLineHistory;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Model\CalendarAttachement;
use Google_Service_Calendar_Event;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
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
      $eventcalendars = EventCalendar::whereNotNull('subject')
                                    ->whereNotNull('eventdate')
                                    ->whereNotNull('starttime')
                                    ->whereNotNull('endtime')
                                    ->whereNotNull('place')
                                    ->whereNotNull('summary')
                                    ->where('status',1)
                                    ->whereIn('full_tbp_id',$fulltbps)
                                    ->get();
      return view('dashboard.admin.calendar.index')->withEventcalendars($eventcalendars); 
    }

    public function Create(){
        $users = User::where('user_type_id','>=',3)->get();
        $calendartypes = CalendarType::get();
        $projectassignments = ProjectAssignment::where('leader_id',Auth::user()->id)->pluck('business_plan_id')->toArray();
        
        $minitbps = MiniTBP::whereIn('business_plan_id',$projectassignments)->pluck('id')->toArray();
        
        $fulltbps = FullTbp::whereIn('mini_tbp_id',$minitbps)->get();
        $isnotifies = Isnotify::get();
        //$CalendarType = CalendarType::get();
        return view('dashboard.admin.calendar.create')->withUsers($users)
                                                    ->withFulltbps($fulltbps)
                                                    ->withCalendartypes($calendartypes)
                                                    ->withIsnotifies($isnotifies);
    }
    public function CreateCalendar($id){
      $users = User::where('user_type_id','>=',3)->get();
      $calendartypes = CalendarType::where('id',3)->get();
      $projectassignments = ProjectAssignment::where('leader_id',Auth::user()->id)->pluck('business_plan_id')->toArray();
      
      $minitbps = MiniTBP::whereIn('business_plan_id',$projectassignments)->pluck('id')->toArray();
      
      $fulltbps = FullTbp::whereIn('mini_tbp_id',$minitbps)->get();
      $fulltbp = FullTbp::find($id);
      $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
      $isnotifies = Isnotify::get();
      //$CalendarType = CalendarType::get();

      $tmpmember=array();
      $id1 = 0;
      $id2 = 0;

      $check =  ProjectMember::where('full_tbp_id',$id)->where('user_id',User::where('user_type_id',5)->first()->id)->first();
      if(Empty($check)){
          $projectmember = new ProjectMember();
          $projectmember->full_tbp_id = $id;
          $projectmember->user_id = User::where('user_type_id',5)->first()->id;
          $projectmember->save();
          $id1 = $projectmember->id;
      }

      $check =  ProjectMember::where('full_tbp_id',$id)->where('user_id',User::where('user_type_id',6)->first()->id)->first();
      if(Empty($check)){
          $projectmember = new ProjectMember();
          $projectmember->full_tbp_id = $id;
          $projectmember->user_id = User::where('user_type_id',6)->first()->id;
          $projectmember->save();
          $id2 = $projectmember->id;
      }

      $projectstatustransactions = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id','>=',4)->count();
      if($projectstatustransactions == 1){
        $calendartypes = CalendarType::where('id','<=',2)->get();
          $expertassignmentarr = ExpertAssignment::where('full_tbp_id',$id)->pluck('user_id')->toArray();
          $expertdetailarr = ExpertDetail::whereIn('user_id',$expertassignmentarr)->where('expert_type_id',2)->pluck('user_id')->toArray();
          $users = User::whereIn('id',$expertdetailarr)->get();
          
          foreach ($users as $key => $user) {
              $projectmember = new ProjectMember();
              $projectmember->full_tbp_id = $id;
              $projectmember->user_id = $user->id;
              $projectmember->save();
              array_push($tmpmember,$projectmember->id);
          }
      }else if($projectstatustransactions == 2){
          $projectstatus = ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',5)->first();
      }

      $projectmembers = ProjectMember::where('full_tbp_id',$id)->get();

      if($id1 != 0){
          ProjectMember::find($id1)->delete();
      }
      if($id2 != 0){
          ProjectMember::find($id2)->delete();
      }
      ProjectMember::where('full_tbp_id',$id)->whereIn('id',$tmpmember)->delete();
      $eventcalendar = EventCalendar::where('full_tbp_id',$fulltbp->id)
        ->whereNull('starttime')
        ->whereNull('endtime')
        ->whereNull('place')
        ->whereNull('summary')
        ->orderBy('id', 'desc')->first();
      if(Empty($eventcalendar)){
        $eventcalendar = new EventCalendar();
        $eventcalendar->full_tbp_id = $fulltbp->id;
        $eventcalendar->eventdate = Carbon::now()->toDateString();
        $eventcalendar->save();
      }
      // $calendar =  EventCalendar::where('full_tbp_id',$id)->first();
// return $projectmembers;
      return view('dashboard.admin.calendar.createcalendar')->withUsers($users)
                                                  ->withFulltbp($fulltbp)
                                                  ->withFulltbps($fulltbps)
                                                  ->withCalendartypes($calendartypes)
                                                  ->withIsnotifies($isnotifies)
                                                  ->withProjectmembers($projectmembers)
                                                  ->withEventcalendar($eventcalendar);
  }
    public function CreateSave(CreateCalendarRequest $request){
      $auth = Auth::user();
      EventCalendar::find($request->eventcalendarid)->update([
          'calendar_type_id' => $request->calendartype,
          'eventdate' => DateConversion::thaiToEngDate($request->eventdate),
          'starttime' => $request->eventtimestart,
          'endtime' => $request->eventtimeend,
          'subject' => $request->subject,
          'place' => $request->place,
          'summary' => $request->summary,
          'isnotify_id' => $request->isnotify
      ]);
      $eventcalendar = EventCalendar::find($request->eventcalendarid);

      if($request->isnotify == 2){
        $meetingdate = new MeetingDate();
        $meetingdate->event_calendar_id = $eventcalendar->id;
        $meetingdate->save();
      }

      $mails = array();
      $joinusers = array();
      foreach($request->users as $user){
          $_user = User::find($user);
          $joinusers[] = 'คุณ' . $_user->name . ' ' . $_user->lastname;
          $mails[] = $_user->email;
          $eventcalendarattendee = new EventCalendarAttendee();
          $eventcalendarattendee->event_calendar_id = $eventcalendar->id;
          $eventcalendarattendee->user_id = $_user->id;
          $eventcalendarattendee->color = '#cc6699';
          $eventcalendarattendee->save();
      }
      $fulltbp = FullTbp::find($request->fulltbp);
      $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
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
          $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
      }else if($bussinesstype == 4){
          $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
      }

      $calendarattachements = CalendarAttachement::where('event_calendar_id',$eventcalendar->id)->get();
      $attachmentfiles = '';
      if($calendarattachements->count() > 0){
        $html = '<ul>';
        foreach ($calendarattachements as $key => $calendarattachement) {
          $html .= '<li><a href="'.url('').'/'.$calendarattachement->path.'" target="_blank" >'.$calendarattachement->name.'</a></li>';
        }
        $attachmentfiles = '<br><br><strong>เอกสารแนบ:</strong><br>' . $html . '</ul>';
      }

      $messageheader = "" ;
      $logname = "";
      if ($request->calendartype == 1) {
        $logname = "ประชุม (briefing) ก่อนการลงพื้นที่ประเมิน";
        $messageheader = "ประชุม (briefing) ก่อนการลงพื้นที่ประเมิน โครงการ" . $minitbp->project . $fullcompanyname;
      }
      else if ($request->calendartype == 2){
        $logname = "ประชุมนัดหมายประเมิน ณ สถานประกอบการ";
         $messageheader = "ประชุมนัดหมายประเมิน ณ สถานประกอบการ โครงการ" . $minitbp->project .$fullcompanyname;
       }else if($request->calendartype == 3){
        $messageheader = "ประชุมและสรุปผลการประเมิน และลงคะแนนโครงการ" . $minitbp->project .$fullcompanyname;
        $logname = "ประชุมและสรุปผลการประเมิน";
       }
      
       EmailBox::send($mails,'TTRS: นัด'.$messageheader,'เรียน ผู้เชี่ยวชาญ <br><br> โปรดเข้าร่วม'.$messageheader. 'มีรายละเอียดดังนี้' .
       '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
       '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
       '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
       '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
       '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
       $attachmentfiles.
       '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

      if ($request->calendartype == 1 ) {
        foreach($request->users as $user){
            $_user = User::find($user);
            $messagebox = Message::sendMessage('นัด'.$messageheader,'โปรดเข้าร่วม'. $messageheader. ' มีรายละเอียดดังนี้' .
            '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
            '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
            '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
            '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
            '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
            $attachmentfiles,Auth::user()->id,$_user->id);
  
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_user->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' นัด'. $messageheader;
            $alertmessage->save();
  
            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
      
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 2;
            $notificationbubble->notification_sub_category_id = 8;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();
        }
      }elseif($request->calendartype == 2){
        foreach($request->users as $user){
            $_user = User::find($user);
            $messagebox = Message::sendMessage('นัด'.$messageheader,'โปรดเข้าร่วม'. $messageheader. ' มีรายละเอียดดังนี้' .
            '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
            '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
            '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
            '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
            '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
            $attachmentfiles,Auth::user()->id,$_user->id);
  
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_user->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' นัด'. $messageheader;
            $alertmessage->save();
  
            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
      
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $minitbp->business_plan_id;
            $notificationbubble->notification_category_id = 2;
            $notificationbubble->notification_sub_category_id = 8;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();
        }

        $messagebox =  Message::sendMessage('นัดหมายเข้าประเมิน ณ สถานประกอบการ โครงการ'.$minitbp->project ,'นัดหมายเข้าประเมิน ณ สถานประกอบการ โครงการ'.$minitbp->project,$auth->id,$company->user_id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $company->user_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' นัดหมายเข้าประเมิน ณ สถานประกอบการ โครงการ'.$minitbp->project;
        $alertmessage->save();
 

        MessageBox::find($messagebox->id)->update([
          'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($company->user_id)->email,'TTRS:นัดหมายการประเมิน ณ สถานประกอบการ','เรียน ผู้ขอรับการประเมิน <br><br> แจ้งนัดหมายการประเมิน ณ สถานประกอบการ มีรายละเอียดดังนี้' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
        '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
        '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
        '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
        $timeLinehistory->mini_tbp_id = $minitbp->id;
        $timeLinehistory->details = 'TTRS: นัดหมายการประเมิน ณ สถานประกอบการ';
        $timeLinehistory->message_type = 2;
        $timeLinehistory->owner_id = $company->user_id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',4)->first()->update([
          'actual_startdate' =>  Carbon::now()->toDateString()
        ]);

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

            //$messagebox =  Message::sendMessage('ประชุมและสรุปผลการประเมิน โครงการ' . $minitbp->project . $fullcompanyname ,'ประชุมและสรุปผลการประเมิน โครงการ' . $minitbp->project . $fullcompanyname. 'สามารถลงคะแนนได้ตั้งแต่วันนี้จนถึงวันก่อนการสรุปผล',$auth->id,$projectmember->user_id);

            $messagebox = Message::sendMessage('นัด'.$messageheader,'โปรดเข้าร่วม'. $messageheader. ' มีรายละเอียดดังนี้' .
            '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
            '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
            '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
            '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
            '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers).
            $attachmentfiles,Auth::user()->id,$projectmember->user_id);
          
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =  $projectmember->user_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' ประชุมและสรุปผลการประเมิน โครงการ' . $minitbp->project . $fullcompanyname ;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
        }
      }

      ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',5)->first()->update([
        'actual_startdate' =>  Carbon::now()->toDateString()
      ]);

      $projectlog = new ProjectLog();
      $projectlog->mini_tbp_id = $minitbp->id;
      $projectlog->user_id = $auth->id;
      $projectlog->action = 'สร้างปฎิทินกิจกรรม (รายละเอียด: ' . $logname . ')';
      $projectlog->save();

      CreateUserLog::createLog('สร้างปฎิทินกิจกรรม นัด' . $messageheader );
      return redirect()->route('dashboard.admin.calendar')->withSuccess('เพิ่มรายการสำเร็จ');
  }
  public function Edit($id){
    $calendartypes = CalendarType::get();
    $eventcalendar = EventCalendar::find($id);
    $calendarattachments = CalendarAttachement::where('event_calendar_id',$eventcalendar->id)->get();
    $eventcalendarattendees = EventCalendarAttendee::where('event_calendar_id',$eventcalendar->id)->get();
    $isnotifies = Isnotify::get();
    $tmpmember=array();
    $tmpmember = ProjectMember::where('full_tbp_id',$eventcalendar->full_tbp_id)->pluck('user_id')->toArray();
    array_push($tmpmember,User::where('user_type_id',5)->first()->id);
    array_push($tmpmember,User::where('user_type_id',6)->first()->id);

    if($eventcalendar->calendar_type_id != 3){
      $expertassignmentarr = ExpertAssignment::where('full_tbp_id',$eventcalendar->full_tbp_id)->pluck('user_id')->toArray();
      $expertdetailarr = ExpertDetail::whereIn('user_id',$expertassignmentarr)->where('expert_type_id',2)->pluck('user_id')->toArray();
      
      foreach ($expertdetailarr as $key => $value) {
        array_push($tmpmember,$value);
      }
    }

   $users = User::whereIn('id',$tmpmember)->get();

    return view('dashboard.admin.calendar.edit')->withUsers($users)
                                                ->withEventcalendar($eventcalendar)
                                                ->withEventcalendarattendees($eventcalendarattendees)
                                                ->withCalendartypes($calendartypes)
                                                ->withIsnotifies($isnotifies)
                                                ->withCalendarattachments($calendarattachments);
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
        $eventcalendar->color = '#cc6699';
        $eventcalendar->user_id =  $_user->id;
        $eventcalendar->save();
    }

    $updateguest_array = array_merge($existing_array,$newguest_array);

    EventCalendar::find($id)->update([
      'eventdate' => DateConversion::thaiToEngDate($request->eventdate),
      'starttime' => $request->eventtimestart,
      'endtime' => $request->eventtimeend,
      'place' => $request->place,
       'subject' => $request->subject,
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
    $businessplan = BusinessPlan::find($minitbp->business_plan_id);
    $company = Company::find($businessplan->company_id);
    $mails = array();
    $joinusers = array();
    foreach($updateguest_array as $user){
        $_user = User::find($user);
        $joinusers[] = 'คุณ'.$_user->name . ' ' . $_user->lastname;
        $mails[] = $_user->email;
    }
    $eventcalendar = EventCalendar::find($id);
    $calendartype = CalendarType::find($eventcalendar->calendar_type_id);
    $calendarattachements = CalendarAttachement::where('event_calendar_id',$request->id)->get();
    $attachmentfiles = '';
    if($calendarattachements->count() > 0){
      $html = '<ul>';
      foreach ($calendarattachements as $key => $calendarattachement) {
        $html .= '<li><a href="'.url('').'/'.$calendarattachement->path.'">'.$calendarattachement->name.'</a></li>';
      }
      $attachmentfiles = '<br><strong>รายการเอกสารแนบ:</strong>' . $html . '</ul>';
    }

    $messageheader = "ประชุมและลงคะแนนการประเมิน โครงการ" . $minitbp->project . " บริษัท" . $company->name;
    $logname = "ประชุม (briefing) ก่อนการลงพื้นที่ประเมิน";
    if ($request->calendartype == 1) {
      $messageheader = "ประชุม (briefing) ก่อนการลงพื้นที่ประเมิน โครงการ" . $minitbp->project . " บริษัท" . $company->name;
    }
    else if ($request->calendartype == 2){
      $logname = "ประชุมนัดหมายประเมิน ณ สถานประกอบการ";
       $messageheader = "ประชุมนัดหมายประเมิน ณ สถานประกอบการ โครงการ" . $minitbp->project . " บริษัท" . $company->name;
     }


    EmailBox::send($mails,'TTRS: (แก้ไข) นัด'.$messageheader,'เรียน ผู้เชี่ยวชาญ <br><br> (แก้ไข) โปรดเข้าร่วม'. $messageheader. ' มีรายละเอียดดังนี้' .
    '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
    '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
    '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
    '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
    '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers)
    .$attachmentfiles.
    '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

    foreach($updateguest_array as $user){
        $_user = User::find($user);

        $messagebox = Message::sendMessage('(แก้ไข) นัด'.$messageheader,'(แก้ไข) โปรดเข้าร่วม'. $messageheader. ' มีรายละเอียดดังนี้' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
        '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
        '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
        '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
        '<br><strong>&nbsp;ผู้เข้าร่วม:</strong> '.implode(", ", $joinusers)
        .$attachmentfiles,Auth::user()->id,$_user->id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $_user->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). $calendartype->name. ' (แก้ไข) สำหรับโครงการ'.$minitbp->project.' ' ;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);
  
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
        EmailBox::send($mails,'TTRS:ยกเลิก ' . $calendartype->name . ' โครงการ'. $minitbp->project,'เรียน ผู้เชี่ยวชาญ <br><br>โปรดทราบว่าการนัดหมาย ดังรายการนี้ได้ <span style="color:red">ยกเลิก</span>  ' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
        '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
        '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
        '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
        '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
    
        foreach($removeguest_array as $user){
            $_user = User::find($user);
            Message::sendMessage('ยกเลิก ' . $calendartype->name . ' โครงการ'. $minitbp->project,'เรียน ผู้เชี่ยวชาญ <br><br>โปรดทราบว่าการนัดหมาย ดังรายการนี้ได้ <span style="color:red">ยกเลิก</span>  ' .
            '<br><br><strong>&nbsp;วันที่:</strong> '.$request->eventdate.
            '<br><strong>&nbsp;เวลา:</strong> '.$request->eventtimestart. ' - ' . $request->eventtimeend .
            '<br><strong>&nbsp;รายละเอียด:</strong> '.$request->summary.
            '<br><strong>&nbsp;สถานที่:</strong> '.$request->place.
            '<br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
        }
    
    }

    $projectlog = new ProjectLog();
    $projectlog->mini_tbp_id = $minitbp->id;
    $projectlog->user_id = $auth->id;
    $projectlog->action = 'แก้ไขปฎิทินกิจกรรม (รายละเอียด: ' . $logname . ')';
    $projectlog->save();

    CreateUserLog::createLog('แก้ไขปฎิทินกิจกรรม โครงการ' . $minitbp->project );
    return redirect()->route('dashboard.admin.calendar')->withSuccess('แก้ไขรายการสำเร็จ');
  }
  public function Delete($id){
    $eventcalendar = EventCalendar::find($id);
    $eventcalendars = Array();
    $eventcalendars = EventCalendarAttendee::where('event_calendar_id',$id)->pluck('user_id')->toArray();
    $fulltbp = FullTbp::find($eventcalendar->full_tbp_id);
    $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
    $businessplan = BusinessPlan::find($minitbp->business_plan_id);
    $company = Company::find($businessplan->company_id);
    $mails = array();
    foreach($eventcalendars as $user){
        $_user = User::find($user);
        $mails[] = $_user->email;
    }

    $calendartype = CalendarType::find($eventcalendar->calendar_type_id);
    EmailBox::send($mails,'TTRS:ยกเลิก ' . $calendartype->name . ' โครงการ'. $minitbp->project,'เรียน ผู้เชี่ยวชาญ <br><br>โปรดทราบว่าการนัดหมายดังรายการได้ <span style="color:red">ยกเลิก</span>  ' .
    '<br><br><strong>&nbsp;วันที่:</strong> '.DateConversion::engToThaiDate($eventcalendar->eventdate).
    '<br><strong>&nbsp;เวลา:</strong> '.$eventcalendar->eventtimestart. ' - ' . $eventcalendar->eventtimeend .
    // '<br><strong>&nbsp;ห้อง:</strong> '.$eventcalendar->room.
    '<br><strong>&nbsp;รายละเอียด:</strong> '.$eventcalendar->summary.
    '<br><strong>&nbsp;สถานที่:</strong> '.$eventcalendar->place.
    '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
    $eventcalendar->delete();
    foreach($eventcalendars as $user){
        $_user = User::find($user);
        Message::sendMessage('ยกเลิก ' . $calendartype->name . ' โครงการ'. $minitbp->project,'เรียน ผู้เชี่ยวชาญ <br><br>โปรดทราบว่าการนัดหมายดังรายการได้ <span style="color:red">ยกเลิก</span>  ' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.DateConversion::engToThaiDate($eventcalendar->eventdate).
        '<br><strong>&nbsp;เวลา:</strong> '.$eventcalendar->eventtimestart. ' - ' . $eventcalendar->eventtimeend .
        // '<br><strong>&nbsp;ห้อง:</strong> '.$eventcalendar->room.
        '<br><strong>&nbsp;รายละเอียด:</strong> '.$eventcalendar->summary.
        '<br><strong>&nbsp;สถานที่:</strong> '.$eventcalendar->place.
        '<br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$_user->id);
    }
    CreateUserLog::createLog('ลบปฎิทินกิจกรรม');
    return redirect()->route('dashboard.admin.calendar')->withSuccess('ลบการสำเร็จ');

  }
}
