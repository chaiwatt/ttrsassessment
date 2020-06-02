<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BusinessPlanFeeTransaction;

class AssessmentController extends Controller
{
    public function Add(Request $request){
        $businessplan = BusinessPlan::where('company_id',$request->companyid)->first();
        if(Empty($businessplan)){
            if($request->status == 1){
                $businessplan = new BusinessPlan();
                $businessplan->company_id = $request->companyid;
                $businessplan->save();
                $businessplanfeetransaction = new BusinessPlanFeeTransaction();
                $businessplanfeetransaction->invoiceno = Carbon::now()->timestamp;
                $businessplanfeetransaction->business_plan_id = $businessplan->id;
                $businessplanfeetransaction->save();
            }
        }else{
            if($request->status == 1){
                $businessplan->where('company_id',$request->companyid)->first()->update([
                    'business_plan_active_status_id' => '1'
                ]);
            }else{
                $businessplan->where('company_id',$request->companyid)->first()->update([
                    'business_plan_active_status_id' => '2'
                ]);
            }
        }
        return response()->json($businessplan);  
    }
}
