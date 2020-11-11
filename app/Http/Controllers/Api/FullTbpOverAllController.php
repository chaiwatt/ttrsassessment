<?php

namespace App\Http\Controllers\Api;

use App\Model\FullTbp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullTbpOverAllController extends Controller
{
    public function Edit(Request $request){
        FullTbp::find($request->id)->update([
            'abtract' => $request->abtract,
            'productdetail' => $request->productdetail,
            'techdev' => $request->techdev,
            'techdevproblem' => $request->techdevproblem,
            'mainproduct' => $request->mainproduct,
            'innovation' => $request->innovation,
            'standard' => $request->standard
        ]);
    }
}
