<?php

namespace App\Http\Controllers;

use App\Mail\EmailSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function Send(){


        $mails = array("ttrsexpert1@gmail.com", "ttrsuser1@gmail.com", "ttrsexpert2@gmail.com");

        $data = [
        'sendermail' => env('MAIL_FROM_ADDRESS'),
        'sendername' => 'TTRS',
        'title' => 'ทดสอบการส่งเมล์',
        'message' => 'นี่คือการทดสอบส่งอีเมล์'
        ];
        Mail::to($mails)->send(new EmailSystem($data));
    }
}
