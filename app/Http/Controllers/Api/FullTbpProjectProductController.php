<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpMainProductDetail;

class FullTbpProjectProductController extends Controller
{
    public function Add(Request $request){
        FullTbpMainProductDetail::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpmainproductdetail = new FullTbpMainProductDetail();
            $fulltbpmainproductdetail->full_tbp_id = $request->id;
            $fulltbpmainproductdetail->line = $line;
            $fulltbpmainproductdetail->save();
        }
        $fulltbpmainproductdetail = FullTbpMainProductDetail::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpmainproductdetail);  
    }
}
