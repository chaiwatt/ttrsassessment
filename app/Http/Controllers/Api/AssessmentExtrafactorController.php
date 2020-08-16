<?php

namespace App\Http\Controllers\Api;

use App\Model\ExtraFactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentExtrafactorController extends Controller
{
    public function Get(Request $request){
        $extrafactors = ExtraFactor::where('sub_cluster_id',$request->subclusterid)->get();
        return response()->json($extrafactors); 
    }
}
