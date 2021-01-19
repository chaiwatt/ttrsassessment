<?php

namespace App\Http\Controllers;

use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;

class DashboardAdminReportController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        // $this->middleware('role:3,4,5,6'); 
    }
    public function Index(){
        $auth = Auth::user();
        $fulltbps = FullTbp::get();

        if($auth->user_type_id == 4){
            $businessplanids = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->pluck('business_plan_id')->toArray();                               
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fulltbparr = FullTbp::whereIn('mini_tbp_id', $minitbpids)->pluck('id')->toArray();

            $expertarr = ExpertAssignment::where('user_id',$auth->id)->where('expert_assignment_status_id',2)->pluck('full_tbp_id')->toArray();
            $uniquefulltbparr = array_unique(array_merge($expertarr,$fulltbparr));
            $fulltbps = FullTbp::whereIn('id',$uniquefulltbparr)->get();

        }else if($auth->user_type_id == 5){
            $projectmembers = ProjectMember::where('user_id',$auth->id)->pluck('full_tbp_id')->toArray();
            $fulltbps = FullTbp::whereIn('id', $projectmembers)->get();
        }
        
        $businessplans = BusinessPlan::get();
        $alertmessages = AlertMessage::where('target_user_id',$auth->id)->get();
        $eventcalendarattendees = EventCalendarAttendee::where('user_id',$auth->id)->get();

        return view('dashboard.admin.report.index')->withEventcalendarattendees($eventcalendarattendees)
                                                ->withFulltbps($fulltbps)
                                                ->withAlertmessages($alertmessages)
                                                ->withBusinessplans($businessplans);
    }
    public function GetEvent(Request $request){
        $auth = Auth::user();
        $eventcalendarattendees = EventCalendarAttendee::where('user_id',$auth->id)->pluck('event_calendar_id')->toArray();
        $eventcalendars = EventCalendar::whereIn('id',$eventcalendarattendees)->get();
        
        $_events = array();
        foreach ($eventcalendars as $event) {
            $eventcalendarattendee = EventCalendarAttendee::where('user_id',$auth->id)->where('event_calendar_id',$event->id)->first();
            $_events[] = array('id' => $event->id,'color' => $eventcalendarattendee->color,'start' => $event->eventdate, 'summary' => $event->summary);
        }
        return collect($_events);
    }
}
