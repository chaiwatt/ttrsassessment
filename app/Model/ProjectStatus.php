<?php

namespace App\Model;

use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getStartdatethAttribute(){
        return DateConversion::engToThaiDate($this->startdate);
    } 
    public function getEnddatethAttribute(){
        return DateConversion::engToThaiDate($this->enddate);
    } 
}
