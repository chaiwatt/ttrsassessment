<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpEmployee;
use App\Http\Controllers\Controller;

class FullTbpCompanyEmployQuantityController extends Controller
{
    public function Edit(Request $request){
        FullTbpEmployee::where('full_tbp_id',$request->id)->first()->update([
            'department1_qty' => $request->department1_qty,
            'department2_qty' => $request->department2_qty,
            'department3_qty' => $request->department3_qty,
            'department4_qty' => $request->department4_qty,
            'department5_qty' => $request->department5_qty
        ]); 
        $fulltbpemployee = FullTbpEmployee::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpemployee); 
    }
}
