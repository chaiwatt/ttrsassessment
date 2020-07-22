<?php

namespace App\Http\Controllers;

use App\Helper\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SmsController extends Controller
{
    public function Index(){
        $otp = rand (1000 , 9999);
        Session::put('otp', $otp);
        SMS::send(Auth::user()->phone,'รหัส OPT สำหรับลงทะเบียนระบบ TTRS: ' . $otp);
        return view('otp.index')->withOtp($otp);
    }

    public function Credit(){
      return  SMS::credit();
    }
    public function Send(){
        return  SMS::send('0882514838','รายงานผลการประเมินระบบ TTRS');
    }

    public function Verify(Request $request){
        $otp = Session::get('otp');
        if(!Empty($otp)){
            if($otp == $request->otp){
                Session::forget('otp');
                return redirect()->route('dashboard.company.report');
            }else{
                return redirect()->back()->withError('รหัส OPT ไม่ถูกต้อง');
            }
        }
        return redirect()->back()->withError('รหัส OPT ไม่ถูกต้อง');
    }
}
