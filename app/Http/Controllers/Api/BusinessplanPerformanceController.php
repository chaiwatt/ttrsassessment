<?php

namespace App\Http\Controllers\Api;

use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BusinessPlanPerformance;

class BusinessplanPerformanceController extends Controller
{
    public function Add(Request $request){
        $businessplanperformance = new BusinessPlanPerformance();
        $businessplanperformance->business_plan_id = $request->id;
        $businessplanperformance->year = $request->performanceyear;
        $businessplanperformance->income = $request->performanceincome;
        $businessplanperformance->netprofit = $request->performancenetprofit;
        $businessplanperformance->totalasset = $request->performancetotalasset;
        $businessplanperformance->totalliability = $request->performancetotalliability;
        $businessplanperformance->save();

        $businessplanperformances = BusinessPlanPerformance::where('business_plan_id',$request->id)->get();
        return response()->json($businessplanperformances);  
    }
}
