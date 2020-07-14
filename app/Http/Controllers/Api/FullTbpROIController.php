<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpReturnOfInvestment;

class FullTbpROIController extends Controller
{
    public function Edit(Request $request){
        $fulltbpreturnofinvestment = FullTbpReturnOfInvestment::find($request->id);
        $fulltbpid = $fulltbpreturnofinvestment->full_tbp_id;
        $fulltbpreturnofinvestment->update([
            'income' => $request->income,
            'profit' => $request->profit,
            'reduce' => $request->reduce
        ]);
        $fulltbpreturnofinvestment = FullTbpReturnOfInvestment::where('full_tbp_id',$fulltbpid)->first();
        return response()->json($fulltbpreturnofinvestment); 
    }
}
