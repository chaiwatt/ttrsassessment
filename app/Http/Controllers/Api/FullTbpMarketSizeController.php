<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpMarketSize;
use App\Http\Controllers\Controller;

class FullTbpMarketSizeController extends Controller
{
    public function Add(Request $request){
        FullTbpMarketSize::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpmarketsize = new FullTbpMarketSize();
            $fulltbpmarketsize->full_tbp_id = $request->id;
            $fulltbpmarketsize->line = $line;
            $fulltbpmarketsize->save();
        }
        $fulltbpmarketsizes = FullTbpMarketSize::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpmarketsizes);  
    }
}
