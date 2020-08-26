<?php

namespace App\Http\Controllers\Api;

use App\Model\Pillar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentEvPillarController extends Controller
{
    public function GetPillar(Request $request){
        $pillars = Pillar::get();
        return response()->json($pillars); 
    }
}
