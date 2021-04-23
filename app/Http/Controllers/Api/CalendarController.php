<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Ev;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\CalendarType;
use App\Model\ExpertDetail;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
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

        return response()->json(array(
            "projectmembers" => $projectmembers,
            "flownothree" => $flownothree,
            "calendartypes" => $calendartypes,
            "projectstatus" => $projectstatus
        ));
    }

    public function GetEvent(Request $request){
        $eventcalendar = EventCalendar::find($request->id);
        $eventcalendarattendees = EventCalendarAttendee::where('event_calendar_id',$request->id)->get();
        $eventcalendarattendeestatuses = EventCalendarAttendeeStatus::get();
        $attendeecalendar = EventCalendarAttendee::where('event_calendar_id',$request->id)->where('user_id',Auth::user()->id)->first();

        return response()->json(array(
            "eventcalendar" => $eventcalendar,
            "eventcalendarattendees" => $eventcalendarattendees,
            "eventcalendarattendeestatuses" => $eventcalendarattendeestatuses,
            "attendeecalendar" => $attendeecalendar
        ));
    }

    public function UpdateJoinEvent(Request $request){
        $eventcalendarattendee = EventCalendarAttendee::find($request->id);
        if(!Empty($eventcalendarattendee)){
            if($request->state == '1'){
                EventCalendarAttendee::find($request->id)->update([
                    'joinevent' => '1',
                    'color' => '#27AE60'
                ]);
            }elseif($request->state == '0'){
                EventCalendarAttendee::find($request->id)->update([
                    'joinevent' => '2',
                    'color' => '#C0392B'
                ]);
            }
            $eventcalendarattendee = EventCalendarAttendee::find($request->id);
            
            return response()->json($eventcalendarattendee);
        }else{
            return null;
        } 
    }
}

