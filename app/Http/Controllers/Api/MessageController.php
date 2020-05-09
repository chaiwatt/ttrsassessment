<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\MessageReceive;
use App\Model\MessageBoxAttachment;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function GetMessage(Request $request){
        $messagereceive = MessageReceive::find($request->messageid);
        $attachment = MessageBoxAttachment::where('message_box_id',$messagereceive->message_box_id)->get();
        return response()->json(array("message" => $messagereceive,"attachment" => $attachment));  
    }
}
