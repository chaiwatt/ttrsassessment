<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function Send(){
        Mail::send('mail', array('key' => 'value'), function($message){
            $message->to('joerocknpc@gmail.com','me')->from('noreply@npctestserver.com')->subject('test');
        });
    }
}
