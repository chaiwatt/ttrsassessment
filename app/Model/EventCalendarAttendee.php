<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\EventCalendarAttendeeStatus;

class EventCalendarAttendee extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['user','eventcalendarattendeestatus'];

    public function getUserAttribute(){
        return User::find($this->user_id);
    } 

    public function getEventcalendarattendeestatusAttribute(){
        return EventCalendarAttendeeStatus::find($this->joinevent);
    } 
}
