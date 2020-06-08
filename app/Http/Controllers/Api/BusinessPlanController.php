<?php

namespace App\Http\Controllers\Api;

use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessPlanController extends Controller
{
    public function Update(Request $request){
        $status = 1;
        if($request->status == 1){
            $status = 2;
        }
        BusinessPlan::find($request->id)->update([
            'business_plan_status_id' => $status
        ]);
        $businessplan = BusinessPlan::find($request->id);  
        return response()->json($businessplan);  
    }
}
