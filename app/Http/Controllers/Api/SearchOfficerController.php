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

        $officerdetailids = OfficerDetail::whereIn('user_id', $projectmemberuniqueids)->pluck('user_id')->toArray();
        $officerdetailuniqueids = array_unique($officerdetailids);
        $officers = User::whereIn('id',$officerdetailuniqueids)->get();
        return response()->json($officers); 
    }

    public function ProjectStatus(Request $request){
        $fulltbpids = FullTbp::where('status','!=',3)->pluck('id')->toArray();
        if($request->projectstatus == 3){
            $fulltbpids = FullTbp::where('status',3)->pluck('id')->toArray();
        }        
        $projectmemberids = ProjectMember::whereIn('full_tbp_id',$fulltbpids)->pluck('user_id')->toArray();
        $projectmemberuniqueids = array_unique($projectmemberids);

        $officerdetailids = OfficerDetail::whereIn('user_id', $projectmemberuniqueids)->pluck('user_id')->toArray();
        $officerdetailuniqueids = array_unique($officerdetailids);
        $officers = User::whereIn('id',$officerdetailuniqueids)->get();
        return response()->json($officers); 
    }
    public function Name(Request $request){
        $userids = User::where('name', 'like', '%' . $request->name . '%')
                    ->orWhere('lastname', 'like', '%' . $request->name . '%')->pluck('id')->toArray();
        $officerdetailids = OfficerDetail::whereIn('user_id', $userids)->pluck('user_id')->toArray();
        $officerdetailuniqueids = array_unique($officerdetailids);
        $officers = User::whereIn('id',$officerdetailuniqueids)->get();
        return response()->json($officers);  
    }
}
