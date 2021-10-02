<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\CalendarType;
use App\Model\ExpertDetail;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Model\CalendarAttachement;
use App\Http\Controllers\Controller;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
use App\Model\EventCalendarAttendeeStatus;

class CalendarController extends Controller
{
    public function GetParticipate(Request $request){
        $tmpmember=array();
        $id1 = 0;
        $id2 = 0;
        $fulltbp = FullTbp::find($request->id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);

        $check =  ProjectMember::where('full_tbp_id',$request->id)->where('user_id',User::where('user_type_id',5)->first()->id)->first();
        if(Empty($check)){
            $projectmember = new ProjectMember();
            $projectmember->full_tbp_id = $request->id;
            $projectmember->user_id = User::where('user_type_id',5)->first()->id;
            $projectmember->save();
            $id1 = $projectmember->id;
        }

        $check =  ProjectMember::where('full_tbp_id',$request->id)->where('user_id',User::where('user_type_id',6)->first()->id)->first();
        if(Empty($check)){
            $projectmember = new ProjectMember();
            $projectmember->full_tbp_id = $request->id;
            $projectmember->user_id = User::where('user_type_id',6)->first()->id;
            $projectmember->save();
            $id2 = $projectmember->id;
        }

        $calendartypes = CalendarType::where('id',3)->get();
        $projectstatustransactions = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id','>=',4)->count();
        if($projectstatustransactions == 1){
            $calendartypes = CalendarType::where('id','<=',2)->get();
            $expertassignmentarr = ExpertAssignment::where('full_tbp_id',$request->id)->pluck('user_id')->toArray();
            $expertdetailarr = ExpertDetail::whereIn('user_id',$expertassignmentarr)->where('expert_type_id',2)->pluck('user_id')->toArray();
            $users = User::whereIn('id',$expertdetailarr)->get();
            
            foreach ($users as $key => $user) {
                $projectmember = new ProjectMember();
                $projectmember->full_tbp_id = $request->id;
                $projectmember->user_id = $user->id;
                $projectmember->save();
                array_push($tmpmember,$projectmember->id);
            }
        }else if($projectstatustransactions == 2){
            $projectstatus = ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',5)->first();
        }

        $projectmembers = ProjectMember::where('full_tbp_id',$request->id)->get();

        $projectstatus = ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',4)->first();
        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id','>=',4)->count();

        $flownothree = 1;
        $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
        if($businessplan->business_plan_status_id >= 6 && $fulltbp->assignexpert == 2 && $ev->status == 4){
            $flownothree = 2;
        }

        if($id1 != 0){
            ProjectMember::find($id1)->delete();
        }
        if($id2 != 0){
            ProjectMember::find($id2)->delete();
        }
        ProjectMember::where('full_tbp_id',$request->id)->whereIn('id',$tmpmember)->delete();

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

        $calendarattachments = CalendarAttachement::where('event_calendar_id',$eventcalendar->id)->get();

        return response()->json(array(
            "projectmembers" => $projectmembers,
            "flownothree" => $flownothree,
            "calendartypes" => $calendartypes,
            "projectstatus" => $projectstatus,
            "eventcalendarid" => $eventcalendar->id,
            "calendarattachments" => $calendarattachments
        ));
    }

    public function GetEvent(Request $request){
        $eventcalendar = EventCalendar::find($request->id);
        $eventcalendarattendees = EventCalendarAttendee::where('event_calendar_id',$request->id)->get();
        $eventcalendarattendeestatuses = EventCalendarAttendeeStatus::get();
        $attendeecalendar = EventCalendarAttendee::where('event_calendar_id',$request->id)->where('user_id',Auth::user()->id)->first();
        $calendarattachments = CalendarAttachement::where('event_calendar_id',$request->id)->get();

        $eventdate = Carbon::createFromFormat('Y-m-d', $eventcalendar->eventdate);
        $passedevent = Carbon::parse(Carbon::now())->DiffInDays($eventdate, false);

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
        $leader = 0;
        $_leader = ProjectAssignment::where('full_tbp_id',$fulltbp->id)->first()->leader_id;
        if(Auth::user()->id == $_leader){
            $leader = 1;
        }

        return response()->json(array(
            "eventcalendar" => $eventcalendar,
            "eventcalendarattendees" => $eventcalendarattendees,
            "eventcalendarattendeestatuses" => $eventcalendarattendeestatuses,
            "attendeecalendar" => $attendeecalendar,
            "calendarattachments" => $calendarattachments,
            "fullcompanyname" => $fullcompanyname,
            "leader" => $leader,
            "passedevent" => $passedevent
        ));
    }

    public function UpdateJoinEvent(Request $request){
        $auth = Auth::user();
        $eventcalendarattendee = EventCalendarAttendee::find($request->id);
        if(!Empty($eventcalendarattendee)){
            if($request->state == '1'){
                EventCalendarAttendee::find($request->id)->update([
                    'joinevent' => '1',
                    'color' => '#DF01A5'
                ]);
            }elseif($request->state == '2'){
                EventCalendarAttendee::find($request->id)->update([
                    'joinevent' => '2',
                    'color' => '#088A08'
                ]);
            }elseif($request->state == '3'){
                EventCalendarAttendee::find($request->id)->update([
                    'joinevent' => '3',
                    'color' => '#B43104',
                    'rejectreason' => $request->rejreason
                ]);
            }

            $eventcalendarattendee = EventCalendarAttendee::find($request->id);
            $eventcalendar = EventCalendar::find($eventcalendarattendee->event_calendar_id);
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
            $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
            if($request->state == '2'){

                $messagebox =  Message::sendMessage('ยืนยันเข้าร่วมประชุม ' . $eventcalendar->subject .' โครงการ' . $minitbp->project ,'คุณ'.$auth->name . ' '. $auth->lastname .' ได้ยืนยันเข้าร่วมประชุม' . $eventcalendar->subject .' โครงการ' . $minitbp->project .$fullcompanyname ,Auth::user()->id,$projectassignment->leader_id);
            
                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id =  $projectassignment->leader_id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' คุณ'.$auth->name . ' '. $auth->lastname .' ยืนยันเข้าร่วมประชุม' . $eventcalendar->subject .' โครงการ' . $minitbp->project ;
                $alertmessage->save();
            
                MessageBox::find($messagebox->id)->update([
                     'alertmessage_id' => $alertmessage->id
                 ]);
                    
                EmailBox::send(User::find($projectassignment->leader_id)->email,'','TTRS: ยืนยันเข้าร่วมประชุม โครงการ' . $minitbp->project .$fullcompanyname,'เรียน Leader<br><br> คุณ'.$auth->name . ' '. $auth->lastname .' ได้ยืนยันเข้าร่วมประชุม' . $eventcalendar->subject .' โครงการ' . $minitbp->project .$fullcompanyname . '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

            }elseif($request->state == '3'){
                $messagebox =  Message::sendMessage('ปฏิเสธเข้าประชุม ' . $eventcalendar->subject .' โครงการ' . $minitbp->project ,'คุณ'.$auth->name . ' '. $auth->lastname .' ปฏิเสธเข้าประชุม' . $eventcalendar->subject .' โครงการ' . $minitbp->project .$fullcompanyname ,Auth::user()->id,$projectassignment->leader_id);
                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id =  $projectassignment->leader_id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' คุณ'.$auth->name . ' '. $auth->lastname .' ปฏิเสธเข้าประชุม' . $eventcalendar->subject .' โครงการ' . $minitbp->project ;
                $alertmessage->save();
            
                MessageBox::find($messagebox->id)->update([
                     'alertmessage_id' => $alertmessage->id
                 ]);
                             
                EmailBox::send(User::find($projectassignment->leader_id)->email,'','TTRS: ปฏิเสธเข้าประชุม โครงการ' . $minitbp->project .$fullcompanyname,'เรียน Leader<br><br> คุณ'.$auth->name . ' '. $auth->lastname .' ได้ปฏิเสธเข้าประชุม' . $eventcalendar->subject .' โครงการ' . $minitbp->project .$fullcompanyname . '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());            
            }

            // $eventcalendar = EventCalendar::find($eventcalendarattendee->event_calendar_id);

            // $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
            // $leader = User::find($projectassignment->leader_id);
    
            // $notificationbubble = new NotificationBubble();
            // $notificationbubble->business_plan_id = $businessplan->id;
            // $notificationbubble->notification_category_id = 1;
            // $notificationbubble->notification_sub_category_id = 5;
            // $notificationbubble->user_id = $auth->id;
            // $notificationbubble->target_user_id = $leader->id;
            // $notificationbubble->save();
    
            // $messagebox = Message::sendMessage('Manager อนุมัติ EV โครงการ' . $minitbp->project .  $fullcompanyname,'Manager ได้อนุมัติ EV โครงการ' . $minitbp->project .  $fullcompanyname.' ขณะนี้อยู่ระหว่าง Admin กำหนด Weight',$auth->id,$leader->id);
            // $alertmessage = new AlertMessage();
            // $alertmessage->user_id = $auth->id;
            // $alertmessage->target_user_id =$leader->id;
            // $alertmessage->messagebox_id = $messagebox->id;
            // $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' Manager อนุมัติ EV โครงการ' . $minitbp->project  . $fullcompanyname .' ขณะนี้อยู่ระหว่าง Admin กำหนด Weight';
            // $alertmessage->save();
    
            // MessageBox::find($messagebox->id)->update([
            //     'alertmessage_id' => $alertmessage->id
            // ]);
    
            // EmailBox::send($leader->email,'','TTRS: Manager อนุมัติ EV โครงการ' . $minitbp->project .  $fullcompanyname,'เรียน Leader<br><br> Manager ได้อนุมัติ EV โครงการ' . $minitbp->project . $fullcompanyname .' ขณะนี้อยู่ระหว่าง Admin กำหนด Weight<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
    

            return response()->json($eventcalendarattendee);
        }else{
            return null;
        } 
    }

    public function JoinEvent(Request $request){
        $auth = Auth::user();
        $eventcalendarattendee = EventCalendarAttendee::where('event_calendar_id',$request->id)->where('id',$request->userid)->first();
        $eventcalendar = EventCalendar::find($eventcalendarattendee->event_calendar_id);
        $calendartype = CalendarType::find($eventcalendar->calendar_type_id);
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

        $messageheader = "" ;
        $logname = "";
        if ($eventcalendar->calendar_type_id == 1) {
          $messageheader = "ประชุม (briefing) ก่อนการลงพื้นที่ประเมิน โครงการ" . $minitbp->project .$fullcompanyname;
        }
        else if ($eventcalendar->calendar_type_id == 2){
           $messageheader = "ประชุมนัดหมายประเมิน ณ สถานประกอบการ โครงการ" . $minitbp->project .$fullcompanyname;

         }else if($eventcalendar->calendar_type_id == 3){
          $messageheader = "ประชุมและสรุปผลการประเมินและลงคะแนนโครงการ" . $minitbp->project .$fullcompanyname;
         }

        $_user = User::find($eventcalendarattendee->user_id);
        $messagebox = Message::sendMessage('(แก้ไข) นัด'.$messageheader . " (เพิ่มโดย Leader)",'โปรดเข้าร่วม'. $messageheader. ' มีรายละเอียด ดังนี้' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.$eventcalendar->eventdate.
        '<br><strong>&nbsp;เวลา:</strong> '.$eventcalendar->eventtimestart. ' - ' . $eventcalendar->eventtimeend .
        '<br><strong>&nbsp;รายละเอียด:</strong><p>'.$eventcalendar->summary.
        '</p><strong>&nbsp;สถานที่:</strong> '.$eventcalendar->place,$auth->id,$_user->id);

        EmailBox::send($_user->email,'','TTRS: (แก้ไข) นัด'.$messageheader . " (เพิ่มโดย Leader)",'เรียน ผู้เชี่ยวชาญ <br><br>โปรดเข้าร่วม'. $messageheader. ' มีรายละเอียด ดังนี้' .
        '<br><br><strong>&nbsp;วันที่:</strong> '.$eventcalendar->eventdate.
        '<br><strong>&nbsp;เวลา:</strong> '.$eventcalendar->eventtimestart. ' - ' . $eventcalendar->eventtimeend .
        '<br><strong>&nbsp;รายละเอียด:</strong><p>'.$eventcalendar->summary.
        '</p><strong>&nbsp;สถานที่:</strong> '.$eventcalendar->place.
        '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $_user->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' '.$calendartype->name. ' (แก้ไข) สำหรับโครงการ'.$minitbp->project.' ' ;
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

        EventCalendarAttendee::where('event_calendar_id',$request->id)->where('id',$request->userid)->first()->update([
                    'joinevent' => '2',
                    'rejectflag' => '1',
                    'color' => '#088A08',
                    'rejectreason' => ''
                ]);
    }

    public function AddAttachment(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/fulltbp/project/calendar/attachment" , $new_name);
        $filelocation = "storage/uploads/fulltbp/project/calendar/attachment/".$new_name;
        $calendarattachment = new CalendarAttachement();
        $calendarattachment->event_calendar_id = $request->eventcalendarid;
        $calendarattachment->name = $file->getClientOriginalName();
        $calendarattachment->path = $filelocation;
        $calendarattachment->save();
        $calendarattachments = CalendarAttachement::where('event_calendar_id',$request->eventcalendarid)->get();
        return response()->json($calendarattachments); 
        // return response()->json($calendarattachment); 
    }

    public function DeleteAttachment(Request $request){
        $calendarattachment = CalendarAttachement::find($request->id);
        $calendarattachmentid = $calendarattachment->event_calendar_id;
        @unlink($calendarattachment->path);  
        $calendarattachment->delete();
        $calendarattachments = CalendarAttachement::where('event_calendar_id',$calendarattachmentid)->get();
        return response()->json($calendarattachments); 
    }
}

