<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpMarketCompetitive;

class FullTbpMarketCompetitiveController extends Controller
{
    public function Add(Request $request){
        FullTbpMarketCompetitive::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpmarketcompetitive = new FullTbpMarketCompetitive();
            $fulltbpmarketcompetitive->full_tbp_id = $request->id;
            $fulltbpmarketcompetitive->line = $line;
            $fulltbpmarketcompetitive->save();
        }
        $fulltbpmarketcompetitives = FullTbpMarketCompetitive::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpmarketcompetitives);  
    }
}
