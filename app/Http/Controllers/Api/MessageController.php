<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\MessageReceive;
use App\Model\MessageBoxAttachment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function GetMessage(Request $request){
        $auth = Auth::user();
        MessageReceive::find($request->messageid)->update([
            'message_read_status_id' => 2
        ]);
        
        $messagereceive = MessageReceive::find($request->messageid);
        $unreadmessages = MessageReceive::where('receiver_id',$auth->id)->where('message_read_status_id',1)->get();
        $attachment = MessageBoxAttachment::where('message_box_id',$messagereceive->message_box_id)->get();
        return response()->json(array("message" => $messagereceive,"attachment" => $attachment,"unreadmessages" => $unreadmessages));  
    }

    public function UploadAttachment(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/message/attachment" , $new_name);
        $filelocation = "storage/uploads/message/attachment/".$new_name;

        $messageboxattachment = new MessageBoxAttachment();
        $messageboxattachment->name = $file->getClientOriginalName();
        $messageboxattachment->attachment = $filelocation;
        $messageboxattachment->save();

        $comming_array  = Array();
        if(count(json_decode($request->inpattachments))>0){
            foreach( json_decode($request->inpattachments) as $key => $item ){
                $comming_array[] = $item;
            } 
        }
        $comming_array[] = $messageboxattachment->id;
        $messageboxattachments = MessageBoxAttachment::whereIn('id', $comming_array)->get();
        return response()->json(array("file" => $messageboxattachment,"messageboxattachments" => $messageboxattachments));  
    }

    public function DeleteAttachment(Request $request){
        $comming_array  = Array();
        if(count(json_decode($request->inpattachments))>0){
            foreach( json_decode($request->inpattachments) as $key => $item ){
                if($item != $request->id){
                    $comming_array[] = $item;
                }  
            } 
        }
        $messageboxattachment = MessageBoxAttachment::find($request->id);
        @unlink($messageboxattachment->attachment);  
        $messageboxattachment->delete();
        $messageboxattachments = MessageBoxAttachment::whereIn('id', $comming_array)->get();
        return response()->json(array("id" => $request->id,"messageboxattachments" => $messageboxattachments));  
    }

}
