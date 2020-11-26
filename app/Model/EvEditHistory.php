<?php

namespace App\Model;

use App\User;
use Carbon\Carbon;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class EvEditHistory extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getUserAttribute(){
        return User::find($this->user_id);
    } 

    public function getThaidateAttribute(){
        return DateConversion::thaiDateTime($this->created_at);
    } 
}
