<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpMarketNeed;
use App\Http\Controllers\Controller;

class FullTbpMarketNeedController extends Controller
{
    public function Add(Request $request){
        FullTbpMarketNeed::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpmarketneed = new FullTbpMarketNeed();
            $fulltbpmarketneed->full_tbp_id = $request->id;
            $fulltbpmarketneed->line = $line;
            $fulltbpmarketneed->save();
        }
        $fulltbpmarketneeds = FullTbpMarketNeed::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpmarketneeds);  
    }
}
