<?php

namespace App\Http\Controllers\Api;

use App\Model\EventCalendar;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;
use App\Model\EventCalendarAttendeeStatus;

class CalendarController extends Controller
{
    public function GetParticipate(Request $request){
        $projectmembers = ProjectMember::where('full_tbp_id',$request->id)->get();
        return response()->json($projectmembers);
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

