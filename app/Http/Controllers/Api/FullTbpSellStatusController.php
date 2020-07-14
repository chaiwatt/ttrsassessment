<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpSellStatus;
use App\Http\Controllers\Controller;

class FullTbpSellStatusController extends Controller
{
    public function Get(Request $request){
        $fulltbpsellstatus = FullTbpSellStatus::find($request->id);
        return response()->json($fulltbpsellstatus); 
    }
    public function Edit(Request $request){
        $fulltbpsellstatus = FullTbpSellStatus::find($request->id);
        $fulltbpid = $fulltbpsellstatus->full_tbp_id;
        $fulltbpsellstatus->update([
            'present' => $request->present,
            'past1' => $request->past1,
            'past2' => $request->past2,
            'past3' => $request->past3,
        ]);
        $fulltbpsellstatuses = FullTbpSellStatus::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpsellstatuses); 
    }
}
