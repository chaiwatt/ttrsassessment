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
            'present' => str_replace(',', '', $request->present),
            'past1' => str_replace(',', '', $request->past1),
            'past2' => str_replace(',', '', $request->past2),
            'past3' => str_replace(',', '', $request->past3),
        ]);
        $fulltbpsellstatuses = FullTbpSellStatus::where('full_tbp_id',$fulltbpid)->orderBy('id','desc')->get();
        return response()->json($fulltbpsellstatuses); 
    }
}
