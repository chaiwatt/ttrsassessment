<?php

namespace App\Model;

use App\Model\MiniTBP;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class MiniTbpHistory extends Model
{
    //
    protected $fillable = [];
    protected $guarded = [];

    public function getMinitbpAttribute(){
        return MiniTBP::find($this->mini_tbp_id);
    } 

    public function getSubmitdateThAttribute(){
        if(!Empty($this->created_at)){
            return DateConversion::thaiDateTime($this->created_at);
        }else{
           return "" ;
        }
    } 
}
