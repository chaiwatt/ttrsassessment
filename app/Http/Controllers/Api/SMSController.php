<?php

namespace App\Http\Controllers\APi;

use DateTimeZone;
use Carbon\Carbon;
use App\Helper\SMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SMSController extends Controller
{
    public function Send(Request $request){
        $otp = rand (1000 , 9999);
        //Session::put('otp', $otp);
        SMS::send($request->phone,'รหัส OPT สำหรับลงทะเบียนระบบ TTRS: ' . $otp);
        return response()->json($otp);  
    }
    public function SaveOtp(Request $request){
        $otp = $request->otp;
        if($request->otp == $request->inp){
            Auth::user()->update([
                'otp' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ]);
        }
        $user = Auth::user();
        // Session::put('otp', $otp);
        // SMS::send($request->phone,'รหัส OPT สำหรับลงทะเบียนระบบ TTRS: ' . $otp);
        return response()->json($user);  
    }
}
