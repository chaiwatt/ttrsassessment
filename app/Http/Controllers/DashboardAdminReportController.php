<?php

namespace App\Http\Controllers;

use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\EventCalendar;
use Illuminate\Http\Request;
use App\Model\ProjectAssignment;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;

class DashboardAdminReportController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        $fulltbps = FullTbp::where('status',2)->get();
        if($auth->user_type_id < 6){
            $businessplanids = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->pluck('business_plan_id')->toArray();
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        }
        $eventcalendarattendees = EventCalendarAttendee::where('user_id',Auth::user())->get();
        return view('dashboard.admin.report.index')->withEventcalendarattendees($eventcalendarattendees)
                                                ->withFulltbps($fulltbps);
    }
    public function GetEvent(Request $request){
        $eventcalendarattendees = EventCalendarAttendee::where('user_id',Auth::user()->id)->pluck('event_calendar_id')->toArray();
        $eventcalendars = EventCalendar::whereIn('id',$eventcalendarattendees)->get();
    
        $_events = array();
        foreach ($eventcalendars as $event) {
            $_events[] = array('start' => $event->eventdate, 'summary' => $event->summary);
        }
        return collect($_events);
    }
}
