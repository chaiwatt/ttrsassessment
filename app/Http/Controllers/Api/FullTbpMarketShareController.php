<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpMarketShare;
use App\Http\Controllers\Controller;

class FullTbpMarketShareController extends Controller
{
    public function Add(Request $request){
        FullTbpMarketShare::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpmarketshare = new FullTbpMarketShare();
            $fulltbpmarketshare->full_tbp_id = $request->id;
            $fulltbpmarketshare->line = $line;
            $fulltbpmarketshare->save();
        }
        $fulltbpmarketshares = FullTbpMarketShare::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpmarketshares);  
    }
}
