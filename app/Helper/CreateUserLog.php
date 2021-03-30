<?php
namespace App\Helper;

use App\Model\UserLog;
use Illuminate\Support\Facades\Auth;

class CreateUserLog
{
    public static function createLog($log){
        $userlog = new UserLog();
        $userlog->user_id = Auth::user()->id;
        $userlog->document = $log;
        $userlog->save();
    } 
}

