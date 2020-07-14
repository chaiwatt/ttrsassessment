<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpCreditPartner;
use App\Http\Controllers\Controller;

class FullTbpCreditPartnerController extends Controller
{
    public function Add(Request $request){
        $fulltbpcreditpartner = new FullTbpCreditPartner();
        $fulltbpcreditpartner->full_tbp_id = $request->id;
        $fulltbpcreditpartner->creditpartner = $request->creditpartner;
        $fulltbpcreditpartner->partnertaxid =$request->partnertaxid;
        $fulltbpcreditpartner->totalyearpurchase = $request->totalyearpurchase;
        $fulltbpcreditpartner->percenttopurchase = $request->percenttopurchase;
        $fulltbpcreditpartner->businessyear = $request->businessyear;
        $fulltbpcreditpartner->save();

        $fulltbpcreditpartners = FullTbpCreditPartner::where('full_tbp_id',$request->id)->get();
        return response()->json($fulltbpcreditpartners);  
    }

    public function Get(Request $request){
        $fulltbpcreditpartner = FullTbpCreditPartner::find($request->id);
        return response()->json($fulltbpcreditpartner); 
    }

    public function Edit(Request $request){
        $fulltbpcreditpartner = FullTbpCreditPartner::find($request->id);
        $fulltbpid = $fulltbpcreditpartner->full_tbp_id;
        $fulltbpcreditpartner->update([
            'creditpartner' => $request->creditpartner,
            'partnertaxid' => $request->partnertaxid,
            'totalyearpurchase' => $request->totalyearpurchase,
            'percenttopurchase' => $request->percenttopurchase,
            'businessyear' => $request->businessyear,
        ]);
        $fulltbpcreditpartners = FullTbpCreditPartner::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpcreditpartners); 
    }

    public function Delete(Request $request){
        $fulltbpcreditpartner = FullTbpCreditPartner::find($request->id);
        $fulltbpid = $fulltbpcreditpartner->full_tbp_id;
        $fulltbpcreditpartner->delete();
        $fulltbpcreditpartners = FullTbpCreditPartner::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpcreditpartners); 
    }

}
