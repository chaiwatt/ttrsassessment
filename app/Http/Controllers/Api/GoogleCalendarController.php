<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helper\GoogleCalendar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GoogleCalendarController extends Controller
{
   public function GetEvents(){
        $events = GoogleCalendar::get();
        $_events = array();
        if (!Empty($events)) {
            foreach ($events as $event) {
                if (count($event->attendees) > 0) {
                    foreach ($event->attendees as $attendee) {
                    if($attendee->email == Auth::user()->email){
                        $_events[] = array('start' => $event->start->dateTime, 'summary' => $event->getSummary(),'url' => $event->htmlLink);
                        break;
                    }
                    }
                }
            }
        }
    return collect($_events);
   }
}
