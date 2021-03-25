<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HidController extends Controller
{
    public function Check(Request $request){
        $arrresult = array();
        if(strlen( $request->hid ) != 13){ 
            $arrresult[] = array(
                'message' => 'ผิดพลาด ไม่สามารถใช้รหัสบัตรประจำตัวประชาชนนี้ได้ เนื่องจากรูปแบบไม่ถูกต้อง', 
                'success' => false
            );
        }
        else{
            for($i=0, $sum=0; $i<12;$i++){
                $sum += (int)( $request->hid[$i] ) * (13-$i);
            }
            if((11-($sum%11))%10 == (int)($request->hid[12] ) ){
                $check = User::where('hid' , $request->hid)->first();
                if( !empty($check) ){
                    $arrresult[] = array(
                        'message' => 'ผิดพลาด ไม่สามารถใช้รหัสบัตรประจำตัวประชาชนนี้ได้ เนื่องจากมีอยู่ในระบบแล้ว', 
                        'success' => false
                    );
                }
                else{
                    $arrresult[] = array(
                        'message' => 'สามารถใช้รหัสบัตรประจำตัวประชาชนนี้ได้', 
                        'success' => true
                    );
                }
            }
            else{
                $arrresult[] = array(
                    'message' => 'ผิดพลาด ไม่สามารถใช้รหัสบัตรประจำตัวประชาชนนี้ได้ เนื่องจากรูปแบบไม่ถูกต้อง', 
                    'success' => false
                );
            }
        }
        return response()->json($arrresult);  
    } 
}
