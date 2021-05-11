<?php

namespace App\Http\Controllers\Api;

use App\Model\Ev;
use App\Model\Pillar;
use Illuminate\Http\Request;
use App\Model\PillaIndexWeigth;
use App\Model\CriteriaTransaction;
use App\Http\Controllers\Controller;

class AssessmentEvPillarController extends Controller
{
    public function GetPillar(Request $request){
        $pillars = Pillar::where('ev_type_id',$request->evtype)->get();
        return response()->json($pillars); 
    }
    public function DeletePillar(Request $request){
        CriteriaTransaction::where('ev_id',$request->evid)
                        ->where('pillar_id',$request->pillarid)
                        ->delete();
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();

        PillaIndexWeigth::where('ev_id',$request->evid)
                                                ->where('pillar_id',$request->pillarid)
                                                ->delete();                                                  

        return response()->json($criteriatransactions); 
    }

    public function GetRelatedEv(Request $request){
        $arrays = CriteriaTransaction::where('ev_id',$request->evid)->get();
        $allfound = true;
        $check = null;
        $ev = array();
        foreach($arrays as $value){  
            $checks = CriteriaTransaction::where('ev_id','!=',$request->evid)
                                    ->where('pillar_id',$value->pillar_id)
                                    ->where('sub_pillar_id', $value->sub_pillar_id)
                                    ->where('sub_pillar_index_id', $value->sub_pillar_index_id)
                                    ->where('criteria_id', $value->criteria_id)->get();                                  
            if($checks->count() != 0){
                foreach($checks as $check){
                    array_push($ev,$check->ev_id);
                }
            }                        
        }
        $_ev = array_count_values($ev);
        $matchedev = array();
        if(count($ev)>0){
            foreach($_ev as $key => $item){
                if(intval($item) == $arrays->count()){
                    $matchedev[] = $key;
                }
            }
        }
        $evs = Ev::whereIn('id',$matchedev)->get();
        return response()->json($evs); 
    }
}
