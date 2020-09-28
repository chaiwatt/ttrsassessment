<?php

namespace App\Http\Controllers\Api;

use App\Model\AlertMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function Delete(Request $request){
        AlertMessage::find($request->id)->delete();
        $alertmessages = AlertMessage::where('target_user_id',Auth::user()->id);
        return response()->json($alertmessages);
    }
}
