<?php
namespace App\Helper;

use App\Mail\EmailSystem;
use Illuminate\Support\Facades\Mail;

class EmailBox
{
    public static function send($mailto,$title,$message){
        $data = [
            'sendermail' => env('MAIL_FROM_ADDRESS'),
            'sendername' => 'TTRS',
            'title' => $title,
            'message' => $message
            ];
            Mail::to($mailto)->send(new EmailSystem($data));
    } 

    public static function emailSignature(){
        $data ='<span style="color:#6C6A6A;"><br>--
        <br>
        <br>Thailand Technology Rating Support and Service Center (TTRS)
        <br>National Science and Technology Development Agency (NSTDA)
        <br>111 Thailand Science Park, Phahonyothin Rd.,
        <br>Klong Nueng, Klong Luang, Pathumthani 12120
        
        <br>Tel.0 2564 7000
        <br>Fax. 0 2564 7004
        <br>website: www.nstda.or.th</span>' ;
            
        return $data;
    } 
}