<?php

namespace App\Http\Controllers\Api;

use App\Model\Cluster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentClusterController extends Controller
{
    public function Get(Request $request){
        $clusters = Cluster::get();
        return response()->json($clusters); 
    }
}
