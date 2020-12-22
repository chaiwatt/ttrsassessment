<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\ExpertDetail;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
use App\Http\Controllers\Controller;

class SearchExpertController extends Controller
{
    public function Branch(Request $request){
        $expertdetailids = ExpertDetail::where('expert_branch_id', $request->branch)->pluck('user_id')->toArray();
        $experts = User::whereIn('id',$expertdetailids)->get();
        return response()->json($experts);  
    }
    public function ProjectName(Request $request){
        $minitbpids = MiniTBP::where('project', 'like', '%' . $request->projectname . '%')
                ->orWhere('projecteng', 'like', '%' . $request->projectname . '%')->pluck('id')->toArray();
        $fulltbpids = FullTbp::whereIn('mini_tbp_id', $minitbpids)->pluck('id')->toArray();
        $expertassignmentids = ExpertAssignment::whereIn('full_tbp_id',$fulltbpids)->pluck('user_id')->toArray();
        $expertassignmentuniqueids = array_unique($expertassignmentids);
        $experts = User::whereIn('id',$expertassignmentuniqueids)->get();
        return response()->json($experts); 
    }
    public function ProjectStatus(Request $request){
        $fulltbpids = FullTbp::where('status','!=',3)->pluck('id')->toArray();
        if($request->projectstatus == 3){
            $fulltbpids = FullTbp::where('status',3)->pluck('id')->toArray();
        }        
        $expertassignmentids = ExpertAssignment::whereIn('full_tbp_id',$fulltbpids)->pluck('user_id')->toArray();
        $expertassignmentuniqueids = array_unique($expertassignmentids);
        $experts = User::whereIn('id',$expertassignmentuniqueids)->get();
        return response()->json($experts); 
    }
}
