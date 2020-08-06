<?php
namespace App\Helper;

use App\Model\MessageBox;


class Message
{
    public static function sendMessage($title,$body,$sender,$receiver){
        $messagebox = new MessageBox();
        $messagebox->title = $title;
        $messagebox->message_priority_id = 1;
        $messagebox->body = $body;
        $messagebox->sender_id = $sender;
        $messagebox->receiver_id = $receiver;
        $messagebox->message_read_status_id = 1;
        $messagebox->save();
        return $messagebox;
    } 
}
