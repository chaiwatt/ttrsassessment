<?php

namespace App\Http\Controllers;

use App\Model\FullTbp;
use App\Model\MiniTBP;
use Illuminate\Http\Request;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardAdminAssessmentController extends Controller
{
    public function Index(){
       
        
        $auth = Auth::user();
        $fulltbps = FullTbp::where('status',2)->get();
        if($auth->user_type_id < 7){
            $businessplanids = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->pluck('business_plan_id')->toArray();
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        }

        return $fulltbps;

        // $businessplan = BusinessPlan::find(MiniTBP::find(FullTbp::find($id)->mini_tbp_id)->business_plan_id);
        // $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        // $existing_array = ProjectScoring::where('full_tbp_id',$fulltbp->id)->where('criteria_group_id',$fulltbp->criteria_group_id)->distinct('user_id')->pluck('user_id')->toArray();
        // $users = array();
        // $users = User::where('user_type_id','>=',7)->pluck('id')->toArray();
        // array_push($users, $projectassignment->leader_id, $projectassignment->coleader_id);
        // $unique_array = array_diff($users, $existing_array);
        // $mails = array();
        // foreach($users as $user){
        //     $_user = User::find($user);
        //     $mails[] = $_user->email;
        // }
        // $pending ='';
        // foreach($unique_array as $user){
        //     $_user = User::find($user);
        //     $pending .= 'คุณ' . $_user->name . '  ' .  $_user->lastname . ',';
        // }
    }
}
