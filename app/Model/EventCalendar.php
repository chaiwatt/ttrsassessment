<?php

namespace App\Model;

use App\Model\FullTbp;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class EventCalendar extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getFullTbpAttribute(){
        return FullTbp::find($this->full_tbp_id);
    } 

    public function getEventdatethAttribute(){
        return DateConversion::engToThaiDate($this->eventdate);
    } 

}
