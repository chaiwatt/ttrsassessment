<?php

namespace App\Model;

use App\User;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class TimeLineHistory extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['user','createdatth'];

    public function getUserAttribute(){
        return User::find($this->user_id);
    }

    public function getCreatedAtThAttribute(){
        return DateConversion::engToThaiDate($this->created_at->toDateString());
    } 
}
