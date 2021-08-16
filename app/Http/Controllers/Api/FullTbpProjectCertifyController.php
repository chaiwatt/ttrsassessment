<?php

namespace App\Http\Controllers\Api;

use App\Model\FullTbp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectCertify;

class FullTbpProjectCertifyController extends Controller
{
    public function Edit(Request $request){
        $cer1 = null;
        $cer2 = null;
        $cer3 = null;
        $cer4 = null;
        $cer5 = null;
        $cer6 = null;
        $cer7 = null;
        $cer8 = null;
        $cer9 = null;
        $cer10 = null;
        $cer11 = null;
        if($request->cer1=='true'){
            $cer1='1';
        }
        if($request->cer2=='true'){
            $cer2='1';
        }
        if($request->cer3=='true'){
            $cer3='1';
        }
        if($request->cer4=='true'){
            $cer4='1';
        }
        if($request->cer5=='true'){
            $cer5='1';
        }
        if($request->cer6=='true'){
            $cer6='1';
        }
        if($request->cer7=='true'){
            $cer7='1';
        }
        if($request->cer8=='true'){
            $cer8='1';
        }
        if($request->cer9=='true'){
            $cer9='1';
        }
        if($request->cer10=='true'){
            $cer10='1';
        }
        if($request->cer11=='true'){
            $cer11='1';
        }

        FullTbpProjectCertify::where('full_tbp_id',$request->id)->first()->update([
            'cer1' => $cer1,
            'cer1_qty' => $request->cer1qty,
            'cer2' => $cer2,
            'cer2_qty' => $request->cer2qty,
            'cer3' => $cer3,
            'cer3_qty' => $request->cer3qty,
            'cer4' => $cer4,
            'cer4_qty' => $request->cer4qty,
            'cer5' => $cer5,
            'cer5_qty' => $request->cer5qty,
            'cer6' => $cer6,
            'cer6_qty' => $request->cer6qty,
            'cer7' => $cer7,
            'cer7_qty' => $request->cer7qty,
            'cer8' => $cer8,
            'cer8_qty' => $request->cer8qty,
            'cer9' => $cer9,
            'cer9_qty' => $request->cer9qty,
            'cer10' => $cer10,
            'cer10_qty' => $request->cer10qty,
            'cer11' => $cer11,
            'cer11_qty' => $request->cer11qty,
        ]);
        $fulltbpprojectcertify = FullTbpProjectCertify::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpprojectcertify); 
    }
}
