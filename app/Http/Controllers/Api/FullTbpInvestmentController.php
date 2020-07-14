<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpInvestment;
use App\Http\Controllers\Controller;

class FullTbpInvestmentController extends Controller
{
    public function Get(Request $request){
        $fulltbpinvestment = FullTbpInvestment::find($request->id);
        return response()->json($fulltbpinvestment); 
    }

    public function Edit(Request $request){
        $fulltbpinvestment = FullTbpInvestment::find($request->id);
        $fulltbpid = $fulltbpinvestment->full_tbp_id;
        $fulltbpinvestment->update([
            'cost' => $request->investment,
        ]);
        $fulltbpinvestments = FullTbpInvestment::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpinvestments); 
    }
}
