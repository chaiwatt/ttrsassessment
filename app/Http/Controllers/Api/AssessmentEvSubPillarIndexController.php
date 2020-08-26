<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\SubPillarIndex;
use App\Http\Controllers\Controller;

class AssessmentEvSubPillarIndexController extends Controller
{
    public function GetSubpillarIndex(Request $request){
        dd('ok');
        // $subpillarindexs = SubPillarIndex::where('sub_pillar_id', $request->value)->get();
        // return response()->json($subpillarindexs); 
    }
}
