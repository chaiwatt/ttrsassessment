<?php
namespace App\Helper;

use App\Model\Ev;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OnlyBelongPerson
{
    public static function LeaderAndExpert($minitbpid){
        $auth = Auth::user();
        $minitbp = MiniTBP::find($minitbpid);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbpid)->first();
        $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
        if($auth->user_type_id == 4){
            $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
            if(!Empty($projectassignment)){
                if(($auth->id != $projectassignment->leader_id) && ($auth->id != $projectassignment->coleader_id)){
                    $expertassignment = ExpertAssignment::where('full_tbp_id',$fulltbp->id)->where('user_id',$auth->id)->where('accepted',1)->first();
                    if(!Empty($expertassignment)){
                        return false;
                    }else{
                        return true;
                    } 
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }else if($auth->user_type_id == 3){
            $expertassignment = ExpertAssignment::where('full_tbp_id',$fulltbp->id)->where('user_id',$auth->id)->where('accepted',1)->first();
            if(!Empty($expertassignment)){
                return false;
            }else{
                return true;
            }
        }else if($auth->user_type_id >= 5){
            return false;
        }else{
            return true;
        }
    }
} 

