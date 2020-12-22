<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\OfficerDetail;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchOfficerController extends Controller
{
    public function Branch(Request $request){
        $dfficerdetailids = OfficerDetail::where('officer_branch_id', $request->branch)->pluck('user_id')->toArray();
        $officers = User::whereIn('id',$dfficerdetailids)->get();
        return response()->json($officers);  
    }

    public function ProjectName(Request $request){
        $minitbpids = MiniTBP::where('project', 'like', '%' . $request->projectname . '%')
                ->orWhere('projecteng', 'like', '%' . $request->projectname . '%')->pluck('id')->toArray();
        $fulltbpids = FullTbp::whereIn('mini_tbp_id', $minitbpids)->pluck('id')->toArray();
        $projectmemberids = ProjectMember::whereIn('full_tbp_id',$fulltbpids)->pluck('user_id')->toArray();
        $projectmemberuniqueids = array_unique($projectmemberids);
        $officers = User::whereIn('id',$projectmemberuniqueids)->get();
        return response()->json($officers); 
    }

    public function ProjectStatus(Request $request){
        $fulltbpids = FullTbp::where('status','!=',3)->pluck('id')->toArray();
        if($request->projectstatus == 3){
            $fulltbpids = FullTbp::where('status',3)->pluck('id')->toArray();
        }        
        $projectmemberids = ProjectMember::whereIn('full_tbp_id',$fulltbpids)->pluck('user_id')->toArray();
        $projectmemberuniqueids = array_unique($projectmemberids);
        $experts = User::whereIn('id',$projectmemberuniqueids)->get();
        return response()->json($experts); 
    }
}
