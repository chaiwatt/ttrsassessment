<?php

namespace App\Http\Controllers;

use App\Model\FullTbp;
use App\Model\EventCalendar;
use Illuminate\Http\Request;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;

class DashboardAdminReportController extends Controller
{
    public function Index(){
        $fulltbbs = FullTbp::get();
        $eventcalendarattendees = EventCalendarAttendee::where('user_id',Auth::user())->get();
        return view('dashboard.admin.report.index')->withEventcalendarattendees($eventcalendarattendees)
                                                ->withFulltbps($fulltbbs);
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
