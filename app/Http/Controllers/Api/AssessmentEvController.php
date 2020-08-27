<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\CheckListGrading;
use App\Model\CriteriaTransaction;
use App\Http\Controllers\Controller;

class AssessmentEvController extends Controller
{
    public function AddEvChecklist(Request $request){
        
        foreach($request->criterias as $criteria){
            $criteriatransaction = new CriteriaTransaction();
            $criteriatransaction->ev_id = $request->evid;
            $criteriatransaction->index_type_id = $request->indextype;
            $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
            $criteriatransaction->criteria_id = $criteria;
            $criteriatransaction->save();
        }

        $checklistgrading = new CheckListGrading();
        $checklistgrading->ev_id = $request->evid;
        $checklistgrading->sub_pillar_index_id = $request->indextype;
        $checklistgrading->gradea = $request->gradea;
        $checklistgrading->gradeb = $request->gradeb;
        $checklistgrading->gradec = $request->gradec;
        $checklistgrading->graded = $request->graded;
        $checklistgrading->gradee = $request->gradee;
        $checklistgrading->gradef = $request->gradef;
        $checklistgrading->save();

        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)->get();
        return response()->json($criteriatransactions); 
    }

    public function AddEvGrading(Request $request){
        $criteriatransaction = new CriteriaTransaction();
        $criteriatransaction->ev_id = $request->evid;
        $criteriatransaction->index_type_id = $request->indextype;
        $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
        $criteriatransaction->save();
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)->get();
        return response()->json($criteriatransactions); 
    }
}
