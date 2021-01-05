<?php

namespace App\Http\Controllers\Api;

use App\Model\FullTbpGantt;
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
            $fulltbpprojectplantransaction->full_tbp_id = $request->id;
            $fulltbpprojectplantransaction->month =  $month;
            $fulltbpprojectplantransaction->save();
        }
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$request->id)->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$request->id)->pluck('id')->toArray();
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();
        FullTbpGantt::where('full_tbp_id',$request->id)->first()->update([
            'startyear' => $request->startyear,
            'numofmonth' => $request->numofmonth,
        ]);

        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$request->id)->distinct('month')->pluck('month')->toArray();
        
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0);
        if(count($fulltbpprojectplantransactionarray) != 0){
            $minmonth = min($fulltbpprojectplantransactionarray);
            $maxmonth = max($fulltbpprojectplantransactionarray);
            $year1 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 1 && $n <= 12;
            }); 
            $year2 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 13 && $n <= 24;
            });
            $year3 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 25 && $n <= 36;
            });
            if(count($year1) != 0){
                if(count($year2) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }
            
            if(count($year2) != 0){
                if(count($year1) != 0){
                    $year2 = range(13,max($year2));
                }else{
                    $year2 = range(min($year2),max($year2));
                }
            }else{
                $year2 = [];
            }
            if(count($year3) != 0){
                if(count($year2) != 0){
                    $year3 = range(25,max($year3));
                }else{
                    $year3 = range(min($year3),max($year3));
                }
            }else{
                $year3 = [];
            }
            $allyears = array(count($year1), count($year2), count($year3));
        }
        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions,
            "minmonth" => $minmonth,
            "maxmonth" => $maxmonth,
            "allyears" => $allyears
        ));
    }

    public function Get(Request $request){
        $fulltbpprojecplan = FullTbpProjectPlan::find($request->id);
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::where('project_plan_id',$request->id)->get();
        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbpprojecplan->full_tbp_id)->distinct('month')->pluck('month')->toArray();
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0);
        if(count($fulltbpprojectplantransactionarray) != 0){
            $minmonth = min($fulltbpprojectplantransactionarray);
            $maxmonth = max($fulltbpprojectplantransactionarray);
            $year1 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 1 && $n <= 12;
            }); 
            $year2 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 13 && $n <= 24;
            });
            $year3 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 25 && $n <= 36;
            });
            if(count($year1) != 0){
                if(count($year2) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }
            
            if(count($year2) != 0){
                if(count($year1) != 0){
                    $year2 = range(13,max($year2));
                }else{
                    $year2 = range(min($year2),max($year2));
                }
            }else{
                $year2 = [];
            }
            if(count($year3) != 0){
                if(count($year2) != 0){
                    $year3 = range(25,max($year3));
                }else{
                    $year3 = range(min($year3),max($year3));
                }
            }else{
                $year3 = [];
            }
            $allyears = array(count($year1), count($year2), count($year3));
        }

        return response()->json(array(
            "fulltbpprojecplan" => $fulltbpprojecplan,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions,
            "minmonth" => $minmonth,
            "maxmonth" => $maxmonth,
            "allyears" => $allyears
        ));
    }

    public function Edit(Request $request){
        $unique_array  = Array();
        foreach( $request->months as $key => $month ){
            $comming_array[] = $month;
        }
        $fulltbpprojectplan = FullTbpProjectPlan::find($request->id);
        FullTbpProjectPlanTransaction::where('project_plan_id',$request->id)->whereNotIn('month',$comming_array)->delete();
        $existing_array = FullTbpProjectPlanTransaction::where('project_plan_id',$request->id)->pluck('month')->toArray();
        $unique_array = array_diff($comming_array, $existing_array);
        foreach($unique_array as $month){
            $fulltbpprojectplantransaction = new FullTbpProjectPlanTransaction();
            $fulltbpprojectplantransaction->project_plan_id = $request->id;
            $fulltbpprojectplantransaction->full_tbp_id = $fulltbpprojectplan->full_tbp_id;
            $fulltbpprojectplantransaction->month =  $month;
            $fulltbpprojectplantransaction->save();
        }
        FullTbpProjectPlan::find($request->id)->update([
            'name' => $request->detail
        ]);
        
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->pluck('id')->toArray();
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();

        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->distinct('month')->pluck('month')->toArray();
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0);
        if(count($fulltbpprojectplantransactionarray) != 0){
            $minmonth = min($fulltbpprojectplantransactionarray);
            $maxmonth = max($fulltbpprojectplantransactionarray);
            $year1 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 1 && $n <= 12;
            }); 
            $year2 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 13 && $n <= 24;
            });
            $year3 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 25 && $n <= 36;
            });
            if(count($year1) != 0){
                if(count($year2) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }
            
            if(count($year2) != 0){
                if(count($year1) != 0){
                    $year2 = range(13,max($year2));
                }else{
                    $year2 = range(min($year2),max($year2));
                }
            }else{
                $year2 = [];
            }
            if(count($year3) != 0){
                if(count($year2) != 0){
                    $year3 = range(25,max($year3));
                }else{
                    $year3 = range(min($year3),max($year3));
                }
            }else{
                $year3 = [];
            }
            $allyears = array(count($year1), count($year2), count($year3));
        }
        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions,
            "minmonth" => $minmonth,
            "maxmonth" => $maxmonth,
            "allyears" => $allyears
        ));
    }

    public function Delete(Request $request){
        $fulltbpprojectplan = FullTbpProjectPlan::find($request->id);
        $fulltbpid = $fulltbpprojectplan->full_tbp_id;
        $fulltbpprojectplan->delete();
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->pluck('id')->toArray();
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();

        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbpid)->distinct('month')->pluck('month')->toArray();
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0);
        if(count($fulltbpprojectplantransactionarray) != 0){
            $minmonth = min($fulltbpprojectplantransactionarray);
            $maxmonth = max($fulltbpprojectplantransactionarray);
            $year1 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 1 && $n <= 12;
            }); 
            $year2 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 13 && $n <= 24;
            });
            $year3 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 25 && $n <= 36;
            });
            if(count($year1) != 0){
                if(count($year2) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }
            
            if(count($year2) != 0){
                if(count($year1) != 0){
                    $year2 = range(13,max($year2));
                }else{
                    $year2 = range(min($year2),max($year2));
                }
            }else{
                $year2 = [];
            }
            if(count($year3) != 0){
                if(count($year2) != 0){
                    $year3 = range(25,max($year3));
                }else{
                    $year3 = range(min($year3),max($year3));
                }
            }else{
                $year3 = [];
            }
            $allyears = array(count($year1), count($year2), count($year3));
        }

        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions,
            "minmonth" => $minmonth,
            "maxmonth" => $maxmonth,
            "allyears" => $allyears
        ));
    }
}