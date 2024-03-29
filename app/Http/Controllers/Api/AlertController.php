<?php

namespace App\Http\Controllers\Api;

use App\Model\MessageBox;
use App\Model\AlertMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function DeleteQ(Request $request){
        $alert = AlertMessage::find($request->id);
        MessageBox::where('alertmessage_id',$alert->id)->update([
            'message_read_status_id' => 2
        ]);
        AlertMessage::find($request->id)->delete();
        $alertmessages = AlertMessage::where('target_user_id',Auth::user()->id)->get();
        return response()->json($alertmessages);
    }

    public function Delete(Request $request){
        $alert = AlertMessage::find($request->id);
        MessageBox::where('alertmessage_id',$alert->id)->update([
            'message_read_status_id' => 2
        ]);
        AlertMessage::find($request->id)->delete();
        $alertmessages = AlertMessage::where('target_user_id',Auth::user()->id)->get();
        return response()->json($alertmessages);
    }

    public function DeleteAlert(Request $request){
        $check = Messagebox::find($request->id);
        $alertid =  $check->alertmessage_id;

        AlertMessage::find($alertid)->delete();
        Messagebox::find($request->id)->update([
            'message_read_status_id' => 2
        ]);
    }

    public function DeleteAlertQ(Request $request){
        $check = Messagebox::find($request->id);
        $alertid =  $check->alertmessage_id;

        AlertMessage::find($alertid)->delete();
        Messagebox::find($request->id)->update([
            'message_read_status_id' => 2
        ]);
    }

    
}
