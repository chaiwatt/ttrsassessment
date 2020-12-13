<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\AlertMessage;
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
        $this->middleware('auth'); 
        $this->middleware('role:1,2'); 
    }
    public function Index(){
        $auth = Auth::user();
        $alertmessages = AlertMessage::where('target_user_id',$auth->id)->get();
        $businessplans = BusinessPlan::where('company_id',Company::where('user_id',$auth->id)->first()->id)->get();
        return view('dashboard.company.report.index')->withBusinessplans($businessplans)
                                                ->withAlertmessages($alertmessages);
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
