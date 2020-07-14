<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpDebtPartner;
use App\Http\Controllers\Controller;

class FullTbpDebtPartnerController extends Controller
{
    public function Add(Request $request){
        $fulltbpdebtpartner = new FullTbpDebtPartner();
        $fulltbpdebtpartner->full_tbp_id = $request->id;
        $fulltbpdebtpartner->debtpartner = $request->debtpartner;
        $fulltbpdebtpartner->numproject = $request->numproject;
        $fulltbpdebtpartner->partnertaxid =$request->partnertaxid;
        $fulltbpdebtpartner->totalyearsell = $request->totalyearsell;
        $fulltbpdebtpartner->percenttosale = $request->percenttosale;
        $fulltbpdebtpartner->businessyear = $request->businessyear;
        $fulltbpdebtpartner->save();

        $fulltbpsells = FullTbpDebtPartner::where('full_tbp_id',$request->id)->get();
        return response()->json($fulltbpsells);  
    }
    public function Get(Request $request){
        $fulltbpdebtpartner = FullTbpDebtPartner::find($request->id);
        return response()->json($fulltbpdebtpartner); 
    }
    public function Edit(Request $request){
        $fulltbpdebtpartner = FullTbpDebtPartner::find($request->id);
        $fulltbpid = $fulltbpdebtpartner->full_tbp_id;
        $fulltbpdebtpartner->update([
            'debtpartner' => $request->debtpartner,
            'numproject' => $request->numproject,
            'partnertaxid' => $request->partnertaxid,
            'totalyearsell' => $request->totalyearsell,
            'percenttosale' => $request->percenttosale,
            'businessyear' => $request->businessyear,
        ]);
        $fulltbpdebtpartners = FullTbpDebtPartner::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpdebtpartners); 
    }

    public function Delete(Request $request){
        $fulltbpdebtpartner = FullTbpDebtPartner::find($request->id);
        $fulltbpid = $fulltbpdebtpartner->full_tbp_id;
        $fulltbpdebtpartner->delete();
        $fulltbpdebtpartners = FullTbpDebtPartner::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpdebtpartners); 
    }
}
