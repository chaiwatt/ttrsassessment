<?php
namespace App\Helper;

use App\Mail\EmailSystem;
use Illuminate\Support\Facades\Mail;

class EmailBox
{
    public static function send($mailto,$title,$message){
        $data = [
            'sendermail' => 'ttrs@nstda.or.th',
            'sendername' => 'TTRS',
            'title' => $title,
            'message' => $message
            ];
            Mail::to($mailto)->send(new EmailSystem($data));
    } 
}