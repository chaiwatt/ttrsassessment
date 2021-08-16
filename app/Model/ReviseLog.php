<?php

namespace App\Model;

use App\User;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class ReviseLog extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getCreatedAtThAttribute(){
        return DateConversion::thaiDateTime2($this->created_at,'full');
    } 
    public function getUserAttribute(){
        $user = User::find($this->user_id);
        return $user->name . ' ' . $user->lastname;
    } 
}
