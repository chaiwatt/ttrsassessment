<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\BusinessPlan;
use App\Model\EventCalendar;
use Illuminate\Http\Request;
use App\Model\TimeLineHistory;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;

class DashboardCompanyReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function Index(){
        $businessplans = BusinessPlan::where('company_id',Company::where('user_id',Auth::user()->id)->first()->id)->get();
        return view('dashboard.company.report.index')->withBusinessplans($businessplans);
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

    public function GetTimeLine(Request $request){
        $timelinehistories = TimeLineHistory::where('owner_id',$request->userid)->orderBy('id','desc')->get();
        return response()->json($timelinehistories); 
    }

    public function EditTimeLineStatus(Request $request){
        TimeLineHistory::find($request->id)->update([
            'status' => '1'
        ]);

        $timelinehistories = TimeLineHistory::where('owner_id',$request->userid)->get();
        return response()->json($timelinehistories); 
    }
    
}
