<?php

namespace App\Model;

use App\Model\FullTbp;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class FullTbpHistory extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getFulltbpAttribute(){
        return FullTbp::find($this->full_tbp_id);
    } 

    public function getSubmitdateThAttribute(){
        if(!Empty($this->created_at)){
            return DateConversion::engToThaiDate($this->created_at->toDateString());
        }else{
           return "" ;
        }
    } 
}
