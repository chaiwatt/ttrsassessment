<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectAbtractDetail;

class FullTbpProjectAbtractController extends Controller
{
    public function Add(Request $request){
        FullTbpProjectAbtractDetail::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpprojectabtractdetail = new FullTbpProjectAbtractDetail();
            $fulltbpprojectabtractdetail->full_tbp_id = $request->id;
            $fulltbpprojectabtractdetail->line = $line;
            $fulltbpprojectabtractdetail->save();
        }
        $fulltbpprojectabtractdetail = FullTbpProjectAbtractDetail::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpprojectabtractdetail);  
    }
}
