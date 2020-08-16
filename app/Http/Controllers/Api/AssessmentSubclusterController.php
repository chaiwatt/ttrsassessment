<?php

namespace App\Http\Controllers\Api;

use App\Model\SubCluster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentSubclusterController extends Controller
{
    public function Get(Request $request){
        $subclusters = SubCluster::where('cluster_id',$request->clusterid)->get();
        return response()->json($subclusters); 
    }
}
