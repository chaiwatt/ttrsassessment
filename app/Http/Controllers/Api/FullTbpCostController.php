<?php

namespace App\Http\Controllers\Api;

use App\Model\FullTbpCost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullTbpCostController extends Controller
{
    public function Get(Request $request){
        $fulltbpcost = FullTbpCost::find($request->id);
        return response()->json($fulltbpcost); 
    }

    public function Edit(Request $request){
        $fulltbpcost = FullTbpCost::find($request->id);
        $fulltbpid = $fulltbpcost->full_tbp_id;
        $fulltbpcost->update([
            'existing' => str_replace(',', '', $request->existing),
            'need' => str_replace(',', '', $request->need),
            'approved' => str_replace(',', '', $request->approved),
            'plan' => str_replace(',', '', $request->plan) ,
        ]);
        $fulltbpcosts = FullTbpCost::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpcosts); 
    }
}
