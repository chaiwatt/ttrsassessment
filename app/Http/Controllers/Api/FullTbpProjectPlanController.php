<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\FullTbpProjectPlan;
use App\Http\Controllers\Controller;
use App\Model\FullTbpProjectPlanTransaction;

class FullTbpProjectPlanController extends Controller
{
    public function Add(Request $request){
        $fulltbpprojecplan = new FullTbpProjectPlan();
        $fulltbpprojecplan->full_tbp_id = $request->id;
        $fulltbpprojecplan->name = $request->detail;
        $fulltbpprojecplan->save();
        foreach($request->months as $month){
            $fulltbpprojectplantransaction = new FullTbpProjectPlanTransaction();
            $fulltbpprojectplantransaction->project_plan_id = $fulltbpprojecplan->id;
            $fulltbpprojectplantransaction->month =  $month;
            $fulltbpprojectplantransaction->save();
        }
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$request->id)->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$request->id)->pluck('id')->toArray();
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();
        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions
        ));
    }

    public function Get(Request $request){
        $fulltbpprojecplan = FullTbpProjectPlan::find($request->id);
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::where('project_plan_id',$request->id)->get();
        return response()->json(array(
            "fulltbpprojecplan" => $fulltbpprojecplan,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions
        ));
    }

    public function Edit(Request $request){
        $unique_array  = Array();
        foreach( $request->months as $key => $month ){
            $comming_array[] = $month;
        }
        FullTbpProjectPlanTransaction::where('project_plan_id',$request->id)->whereNotIn('month',$comming_array)->delete();
        $existing_array = FullTbpProjectPlanTransaction::where('project_plan_id',$request->id)->pluck('month')->toArray();
        $unique_array = array_diff($comming_array, $existing_array);
        foreach($unique_array as $month){
            $fulltbpprojectplantransaction = new FullTbpProjectPlanTransaction();
            $fulltbpprojectplantransaction->project_plan_id = $request->id;
            $fulltbpprojectplantransaction->month =  $month;
            $fulltbpprojectplantransaction->save();
        }
        FullTbpProjectPlan::find($request->id)->update([
            'name' => $request->detail
        ]);
        $fulltbpprojectplan = FullTbpProjectPlan::find($request->id);
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->pluck('id')->toArray();
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();
        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions
        ));
    }

    public function Delete(Request $request){
        $fulltbpprojectplan = FullTbpProjectPlan::find($request->id);
        $fulltbpid = $fulltbpprojectplan->full_tbp_id;
        $fulltbpprojectplan->delete();
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->pluck('id')->toArray();
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();
        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions
        ));
    }
}