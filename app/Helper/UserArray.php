<?php
namespace App\Helper;

use App\User;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\DB;

class UserArray
{
    public static function leader($businessplanid){
        $arr = ProjectAssignment::where('business_plan_id',$businessplanid)->pluck('leader_id')->toArray();
        if(in_array(null, $arr, true) == false){
            return $arr;
        }else{
            return [];
        }
       
    } 
    public static function coleader($businessplanid){
        $arr = ProjectAssignment::where('business_plan_id',$businessplanid)->pluck('leader_id')->toArray();
        if(in_array(null, $arr, true) == false){
            return $arr;
        }else{
            return [];
        }
    } 
    public static function adminandjd(){
        $arr=array();
        array_push($arr,User::where('user_type_id',6)->first()->id,User::where('user_type_id',5)->first()->id);
        return $arr;
    } 
    public static function expert($businessplanid){
        $businessplan = BusinessPlan::find($businessplanid);
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $arr = ExpertAssignment::where('full_tbp_id',$fulltbp->id)->pluck('user_id')->toArray();
        return $arr;
    } 
    public static function projectmember($businessplanid){
        $businessplan = BusinessPlan::find($businessplanid);
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $arr = ProjectMember::where('full_tbp_id',$fulltbp->id)->pluck('user_id')->toArray();
        return $arr;
    } 
}
