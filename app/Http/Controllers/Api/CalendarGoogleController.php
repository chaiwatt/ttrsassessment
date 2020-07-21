<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helper\GoogleCalendar;
use App\Http\Controllers\Controller;

class CalendarGoogleController extends Controller
{
    public function GetEvent(Request $request){
        $events = GoogleCalendar::get();
        // $myvents = array();
        // if (!Empty($events)) {
        //     foreach ($events as $event) {
        //         if (count($event->attendees) > 0) {
        //             foreach ($event->attendees as $attendee) {
        //               $attendees .= $attendee->email . ' ';
        //               if($attendee->email == $request->email){
        //                 $myvents[] = array('email' => $attendee->email, 'summary' => $event->getSummary(),'link' => $event->htmlLink);
        //                 break;
        //               }
        //             }
        //         }
        //     }
        // }
       return response()->json($events); 
    }
}
