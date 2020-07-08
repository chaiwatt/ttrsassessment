<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpProductDetail;
use App\Http\Controllers\Controller;

class FullTbpProductDetailController extends Controller
{
    public function Add(Request $request){
        FullTbpProductDetail::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpproductdetail = new FullTbpProductDetail();
            $fulltbpproductdetail->full_tbp_id = $request->id;
            $fulltbpproductdetail->line = $line;
            $fulltbpproductdetail->save();
        }
        $fulltbpproductdetail = FullTbpProductDetail::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpproductdetail);  
    }
}
