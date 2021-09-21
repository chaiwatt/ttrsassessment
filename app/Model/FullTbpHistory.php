<?php

namespace App\Model;

use App\User;
use App\Model\FullTbp;
use App\Model\ReviseLog;
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
            return DateConversion::thaiDateTime($this->created_at);
        }else{
           return "" ;
        }
    } 

    public function getReviselogAttribute(){
        $reviselog = ReviseLog::find($this->revise_log_id);
        if(!Empty($reviselog)){
            $user = User::find($reviselog->user_id);
            return strip_tags($reviselog->message) . ' ('. $user->name.' '.$user->lastname.')' ;
        }else{
            return '';
        }
        
    } 
}
