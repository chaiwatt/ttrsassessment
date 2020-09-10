<?php

namespace App\Http\Controllers\Api;

use App\Model\Ev;
use Illuminate\Http\Request;
use App\Model\CheckListGrading;
use App\Model\PillaIndexWeigth;
use App\Model\CriteriaTransaction;
use App\Http\Controllers\Controller;

class AssessmentEvController extends Controller
{
    public function AddEvChecklist(Request $request){
        
        foreach($request->criterias as $criteria){
            $criteriatransaction = new CriteriaTransaction();
            $criteriatransaction->ev_id = $request->evid;
            $criteriatransaction->index_type_id = $request->indextype;
            $criteriatransaction->pillar_id = $request->pillar;
            $criteriatransaction->sub_pillar_id = $request->subpillar;
            $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
            $criteriatransaction->criteria_id = $criteria;
            $criteriatransaction->save();
        }

        $checklistgrading = new CheckListGrading();
        $checklistgrading->ev_id = $request->evid;
        $checklistgrading->pillar_id = $request->pillar;
        $checklistgrading->sub_pillar_id = $request->subpillar;
        $checklistgrading->sub_pillar_index_id = $request->indextype;
        $checklistgrading->gradea = $request->gradea;
        $checklistgrading->gradeb = $request->gradeb;
        $checklistgrading->gradec = $request->gradec;
        $checklistgrading->graded = $request->graded;
        $checklistgrading->gradee = $request->gradee;
        $checklistgrading->gradef = $request->gradef;
        $checklistgrading->save();

        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        if(Empty($pillaindexweigth)){
            $pillaindexweigth = new PillaIndexWeigth();
            $pillaindexweigth->ev_id = $request->evid;
            $pillaindexweigth->pillar_id = $request->pillar;
            $pillaindexweigth->sub_pillar_id = $request->subpillar;
            $pillaindexweigth->sub_pillar_index_id = $request->subpillar;
            $pillaindexweigth->weigth = 0;
            $pillaindexweigth->save();
        }

        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json($criteriatransactions); 
    }

    public function AddEvGrading(Request $request){
        $criteriatransaction = new CriteriaTransaction();
        $criteriatransaction->ev_id = $request->evid;
        $criteriatransaction->index_type_id = $request->indextype;
        $criteriatransaction->pillar_id = $request->pillar;
        $criteriatransaction->sub_pillar_id = $request->subpillar;
        $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
        $criteriatransaction->save();

        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        if(Empty($pillaindexweigth)){
            $pillaindexweigth = new PillaIndexWeigth();
            $pillaindexweigth->ev_id = $request->evid;
            $pillaindexweigth->pillar_id = $request->pillar;
            $pillaindexweigth->sub_pillar_id = $request->subpillar;
            $pillaindexweigth->sub_pillar_index_id = $request->subpillar;
            $pillaindexweigth->weigth = 0;
            $pillaindexweigth->save();
        }

        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json($criteriatransactions); 
    }
    public function GetEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json($criteriatransactions); 
    }
    public function GetEvByFulltbp(Request $request){
        $ev = Ev::where('full_tbp_id',$request->fulltbpid)->first();
        if(Empty($ev)){
            return response()->json($ev); 
        }else{
            $criteriatransactions = CriteriaTransaction::where('ev_id',$ev->id)
                                                    ->orderBy('pillar_id','asc')
                                                    ->orderBy('sub_pillar_id', 'asc')
                                                    ->orderBy('sub_pillar_index_id', 'asc')
                                                    ->get();
            return response()->json($criteriatransactions); 
        }
    }
    public function CopyEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->orgevid)
                                                    ->orderBy('pillar_id','asc')
                                                    ->orderBy('sub_pillar_id', 'asc')
                                                    ->orderBy('sub_pillar_index_id', 'asc')
                                                    ->get();
        CriteriaTransaction::where('ev_id',$request->newevid)->delete();  

        foreach($criteriatransactions as $criteriatransaction){
            $new = new CriteriaTransaction();
            $new->ev_id = $request->newevid;
            $new->index_type_id = $criteriatransaction->index_type_id;
            $new->pillar_id = $criteriatransaction->pillar_id;
            $new->sub_pillar_id = $criteriatransaction->sub_pillar_id;
            $new->sub_pillar_index_id = $criteriatransaction->sub_pillar_index_id;
            $new->criteria_id = $criteriatransaction->criteria_id;
            $new->save();

            $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->newevid)->where('sub_pillar_index_id',$new->sub_pillar_index_id)->first();
            if(Empty($pillaindexweigth)){
                $pillaindexweigth = new PillaIndexWeigth();
                $pillaindexweigth->ev_id = $new->ev_id;
                $pillaindexweigth->pillar_id = $new->pillar_id;
                $pillaindexweigth->sub_pillar_id = $new->sub_pillar_id;
                $pillaindexweigth->sub_pillar_index_id = $new->sub_pillar_index_id;
                $pillaindexweigth->weigth = 0;
                $pillaindexweigth->save();
            }
        }  
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->newevid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();     
        return response()->json($criteriatransactions);                                      
    }

    public function UpdateEvStatus(Request $request){
        Ev::find($request->id)->update([
            'status' => $request->chkevstatus
        ]);
        $ev = Ev::find($request->id);
        return response()->json($ev);
    }
}
