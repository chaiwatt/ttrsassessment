<?php

namespace App\Http\Controllers\Api;

use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ProjectStatusTransaction;

class ControlFlow extends Controller
{
    public function Get(Request $request){
        $projectstatuses = ProjectStatus::where('mini_tbp_id',$request->minitbpid)->get()->each->append('projectflow')->each->append('controlflowstage3approve');
        $projectstatustransactions = ProjectStatusTransaction::where('mini_tbp_id',$request->minitbpid)->get();
        return response()->json(array(
            "projectstatuses" => $projectstatuses,
            "projectstatustransactions" => $projectstatustransactions
        ));
    }
}
