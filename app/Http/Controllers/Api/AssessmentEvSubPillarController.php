<?php

namespace App\Http\Controllers\Api;

use App\Model\Criteria;
use App\Model\IndexType;
use App\Model\SubPillar;
use Illuminate\Http\Request;
use App\Model\SubPillarIndex;
use App\Http\Controllers\Controller;

class AssessmentEvSubPillarController extends Controller
{
    public function GetSubPillar(Request $request){
        $subpillars = SubPillar::where('pillar_id', $request->value)->get();
        return response()->json($subpillars); 
    }

    public function GetSubPillarIndex(Request $request){
        $subpillarindexs = SubPillarIndex::where('sub_pillar_id', $request->value)->get();
        $indextypes = IndexType::get();
        return response()->json(array(
            "indextypes" => $indextypes,
            "subpillarindexs" => $subpillarindexs
        ));
    }

    public function GetCriteria(Request $request){
        $criterias = Criteria::where('sub_pillar_index_id', $request->value)->get();
        return response()->json($criterias); 
    }
}
