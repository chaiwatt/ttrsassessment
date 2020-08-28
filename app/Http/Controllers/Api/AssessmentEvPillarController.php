<?php

namespace App\Http\Controllers\Api;

use App\Model\Pillar;
use Illuminate\Http\Request;
use App\Model\CriteriaTransaction;
use App\Http\Controllers\Controller;

class AssessmentEvPillarController extends Controller
{
    public function GetPillar(Request $request){
        $pillars = Pillar::get();
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
        return response()->json($criteriatransactions); 
    }


    
}
