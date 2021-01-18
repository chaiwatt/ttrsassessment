<?php

namespace App\Http\Controllers\Api;

use App\Model\Ev;
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
        $criteriatransactions = CriteriaTransaction::where('ev_id', $request->evid)->get();
        return response()->json(array(
            "criterias" => $criterias,
            "criteriatransactions" => $criteriatransactions
        ));
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

    public function AddSubpillar(Request $request){
        $subpillar = new SubPillar();
        $subpillar->pillar_id = $request->pillar;
        $subpillar->name = $request->value;
        $subpillar->save();
        $subpillars = SubPillar::where('pillar_id', $request->pillar)->get();
        return response()->json($subpillars); 
    }

    public function EditSubpillar(Request $request){
        $subpillar = SubPillar::find($request->id)->update([
            'name' => $request->value
        ]);
        $subpillars = SubPillar::where('pillar_id', $request->pillar)->get();
        return response()->json($subpillars); 
    }

    public function EditSubPillarIndex(Request $request){
        SubPillarIndex::find($request->id)->update([
            'name' => $request->value
        ]);
        $subpillarindexs = SubPillarIndex::where('sub_pillar_id', $request->subpillar)->get();
        $indextypes = IndexType::get();
        return response()->json(array(
            "indextypes" => $indextypes,
            "subpillarindexs" => $subpillarindexs
        ));
    }

    public function EditCriteria(Request $request){
        Criteria::find($request->id)->update([
            'name' => $request->value
        ]);
        $criterias = Criteria::where('sub_pillar_index_id', $request->subpillarindex)->get();
        return response()->json($criterias); 
    }

    public function AddSubPillarIndex(Request $request){
        $subpillarindex = new SubPillarIndex();
        $subpillarindex->sub_pillar_id = $request->subpillar;
        $subpillarindex->name = $request->value;
        $subpillarindex->save();

        $subpillarindexs = SubPillarIndex::where('sub_pillar_id', $request->subpillar)->get();
        $indextypes = IndexType::get();
        return response()->json(array(
            "indextypes" => $indextypes,
            "subpillarindexs" => $subpillarindexs
        ));
    }

    public function AddCriteria(Request $request){
        $criteria = new Criteria();
        $criteria->sub_pillar_index_id = $request->subpillarindex;
        $criteria->name = $request->value;
        $criteria->save();
        $criterias = Criteria::where('sub_pillar_index_id', $request->subpillarindex)->get();
        return response()->json($criterias); 
    }

    public function GetRelatedEv(Request $request){
        // dd('ok');
        $criteriatransactionarray = CriteriaTransaction::where('ev_id',$request->evid)->pluck('sub_pillar_index_id')->toArray();
        array_push($criteriatransactionarray,$request->subpillarindex);
        $criteriatransactions = CriteriaTransaction::where('sub_pillar_id',$request->subpillar)->whereIn('sub_pillar_index_id',$criteriatransactionarray)->distinct('ev_id')->pluck('ev_id')->toArray();
        $evs = Ev::whereIn('id',$criteriatransactions)->get();
        return response()->json($evs); 
    }
    
}
