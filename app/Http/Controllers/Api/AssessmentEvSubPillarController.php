<?php

namespace App\Http\Controllers\Api;

use App\Model\Criteria;
use App\Model\IndexType;
use App\Model\SubPillar;
use Illuminate\Http\Request;
use App\Model\SubPillarIndex;
use App\Model\CheckListGrading;
use App\Model\CriteriaTransaction;
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

    public function DeleteSubPillar(Request $request){
        CriteriaTransaction::where('ev_id',$request->evid)
                        ->where('pillar_id',$request->pillarid)
                        ->where('sub_pillar_id',$request->subpillarid)
                        ->delete();

        CheckListGrading::where('ev_id',$request->evid)
                    ->where('pillar_id',$request->pillarid)
                    ->where('sub_pillar_id',$request->subpillarid)
                    ->delete();
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json($criteriatransactions); 
    }
    public function DeleteSubPillarIndex(Request $request){
        CriteriaTransaction::where('ev_id',$request->evid)
                        ->where('pillar_id',$request->pillarid)
                        ->where('sub_pillar_id',$request->subpillarid)
                        ->where('sub_pillar_index_id',$request->subpillarindexid)
                        ->delete();

        CheckListGrading::where('ev_id',$request->evid)
                    ->where('pillar_id',$request->pillarid)
                    ->where('sub_pillar_id',$request->subpillarid)
                    ->where('sub_pillar_index_id',$request->subpillarindexid)
                    ->delete();
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json($criteriatransactions); 
    }
}
