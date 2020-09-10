<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\PillaIndexWeigth;
use App\Http\Controllers\Controller;

class AssessmentEvPillarIndexWeigthController extends Controller
{

    public function GetWeigth(Request $request){
        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        return response()->json($pillaindexweigth); 
    }
    public function EditWeigth(Request $request){
        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        // if(Empty($pillaindexweigth)){
        //     $pillaindexweigth = new PillaIndexWeigth();
        //     $pillaindexweigth->ev_id = $request->evid;
        //     $pillaindexweigth->pillar_id = $new->pillar_id;
        //     $pillaindexweigth->sub_pillar_id = $new->sub_pillar_id;
        //     $pillaindexweigth->sub_pillar_index_id = $request->subpillarindex;
        //     $pillaindexweigth->weigth = $request->weigth;
        //     $pillaindexweigth->save();
        // }else{
            $pillaindexweigth->update([
                'weigth' => $request->weigth
            ]);
        //  }
        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        return response()->json($pillaindexweigth); 
    }
}
