<?php

namespace App\Model;

use App\User;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    public function getUserAttribute(){
        $user = User::find($this->user_id);
        return $user;
    } 

    public function getCreatedAtThAttribute(){
        return DateConversion::thaiDateTime($this->created_at,'full');
    } 
}
