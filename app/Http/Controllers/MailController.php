<?php

namespace App\Http\Controllers;

use App\Mail\EmailSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function Send(){
        $data = [
        'sendermail' => env('MAIL_FROM_ADDRESS'),
        'sendername' => 'TTRS',
        'title' => 'ทดสอบการส่งเมล์',
        'message' => 'นี่คือการทดสอบส่งอีเมล์'
        ];
        Mail::to('joerocknpc@gmail.com')->send(new EmailSystem($data));
        // return redirect()->back();
    }
}
