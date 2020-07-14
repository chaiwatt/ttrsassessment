<?php

namespace App\Http\Controllers\Api;

use App\Model\FullTbpSell;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullTbpSellController extends Controller
{
    public function Add(Request $request){
        $fulltbpsell = new FullTbpSell();
        $fulltbpsell->full_tbp_id = $request->id;
        $fulltbpsell->name = $request->name;
        $fulltbpsell->present =$request->present;
        $fulltbpsell->past1 = $request->past1;
        $fulltbpsell->past2 = $request->past2;
        $fulltbpsell->past3 = $request->past3;
        $fulltbpsell->save();

        $fulltbpsells = FullTbpSell::where('full_tbp_id',$request->id)->get();
        return response()->json($fulltbpsells);  
    }
    public function Delete(Request $request){
        $fulltbpsell = FullTbpSell::find($request->id);
        $fulltbpid = $fulltbpsell->full_tbp_id;
        $fulltbpsell->delete();
        $fulltbpsells = FullTbpSell::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpsells); 
    }
    public function Get(Request $request){
        $fulltbpsell = FullTbpSell::find($request->id);
        return response()->json($fulltbpsell); 
    }
    public function Edit(Request $request){
        $fulltbpsell = FullTbpSell::find($request->id);
        $fulltbpid = $fulltbpsell->full_tbp_id;
        $fulltbpsell->update([
            'name' => $request->name,
            'present' => $request->present,
            'past1' => $request->past1,
            'past2' => $request->past2,
            'past3' => $request->past3,
        ]);
        $fulltbpsells = FullTbpSell::where('full_tbp_id',$fulltbpid)->get();
        return response()->json($fulltbpsells); 
    }
}