<?php

namespace App\Model;

use App\Model\FullTbp;
use App\Model\CalendarType;
use App\Helper\DateConversion;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class EventCalendar extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['fulltbp','eventdateth','calendartype','eventcalendarattendee'];

    public function getFullTbpAttribute(){
        return FullTbp::find($this->full_tbp_id);
    } 

    public function getEventdatethAttribute(){
        return DateConversion::engToThaiDate($this->eventdate);
    } 

    public function getPrevioustype1Attribute(){
        return EventCalendar::where('full_tbp_id',$this->full_tbp_id)
        ->where('calendar_type_id',1)
        ->whereNotNull('subject')
        ->orderBy('id','asc')
        ->first()
        ->eventdate;
    } 
    public function getPrevioustype2Attribute(){
        return EventCalendar::where('full_tbp_id',$this->full_tbp_id)
        ->where('calendar_type_id',2)
        ->whereNotNull('subject')
        ->orderBy('id','asc')
        ->first()
        ->eventdate;
    } 

    public function getCalendartypeAttribute(){
        return CalendarType::find($this->calendar_type_id);
    } 
    public function getEventcalendarattendeeAttribute(){
        return EventCalendarAttendee::where('event_calendar_id',$this->calendar_type_id)->where('user_id',Auth::user()->id)->first();
    } 
}
