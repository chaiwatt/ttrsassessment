<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectTechDevProblem;

class FullTbpProjectTechDevProblemController extends Controller
{
    public function Add(Request $request){
        FullTbpProjectTechDevProblem::where('full_tbp_id',$request->id)->delete(); 
        foreach($request->lines as $line){
            $fulltbpprojecttechdevproblem = new FullTbpProjectTechDevProblem();
            $fulltbpprojecttechdevproblem->full_tbp_id = $request->id;
            $fulltbpprojecttechdevproblem->line = $line;
            $fulltbpprojecttechdevproblem->save();
        }
        $fulltbpprojecttechdevproblems = FullTbpProjectTechDevProblem::where('full_tbp_id',$request->id)->first();
        return response()->json($fulltbpprojecttechdevproblems);  
    }
}
