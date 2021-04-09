<?php

namespace App\Model;

use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class EmployExperience extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    // protected $appends = ['startdateth','enddateth'];

    // public function getStartdateThAttribute()
    // {
    //     return DateConversion::engToThaiDate($this->startdate);
    // }
    // public function getEnddateThAttribute()
    // {
    //     return DateConversion::engToThaiDate($this->enddate);
    // }
}
