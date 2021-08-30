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
        $fulltbpprojecplanarr = FullTbpProjectPlan::where('full_tbp_id',$request->id)->pluck('itemorder')->toArray();
        $max = 1;
        if(count($fulltbpprojecplanarr) != 0){
            $max = max($fulltbpprojecplanarr) + 1;
        }

        $fulltbpprojecplan = new FullTbpProjectPlan();
        $fulltbpprojecplan->full_tbp_id = $request->id;
        $fulltbpprojecplan->itemorder = $max;
        $fulltbpprojecplan->name = $request->detail;
        $fulltbpprojecplan->save();
        foreach($request->months as $month){
            $fulltbpprojectplantransaction = new FullTbpProjectPlanTransaction();
            $fulltbpprojectplantransaction->project_plan_id = $fulltbpprojecplan->id;
            $fulltbpprojectplantransaction->full_tbp_id = $request->id;
            $fulltbpprojectplantransaction->month =  $month;
            $fulltbpprojectplantransaction->save();
        }
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$request->id)->orderBy('itemorder','asc')->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$request->id)->pluck('id')->toArray();
        
        FullTbpGantt::where('full_tbp_id',$request->id)->first()->update([
            'startyear' => $request->startyear,
        ]);

        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$request->id)->distinct('month')->pluck('month')->toArray();
        
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0,0);
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
            $year4 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 37 && $n <= 48;
            });

            //=====new method check year one
            if(count($year1) != 0){
                if(count($year2) != 0 || count($year3) != 0 || count($year4) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }

            //===== new method check year two
            if(count($year1) != 0){
                if(count($year3) != 0 || count($year4) != 0){
                        $year2 = range(13,24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(13,max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }else{
                if(count($year3) != 0 || count($year4) != 0){
                    $year2 = range(min($year2),24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(min($year2),max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }

            
            //==== year three

            if(count($year1) != 0 || count($year2) != 0){
                if(count($year4) != 0){
                    $year3 = range(25,36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(25,max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }else{
                if(count($year4) != 0){
                    $year3 = range(min($year3),36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(min($year3),max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }

            //===== new method check year foure
            if(count($year1) != 0 || count($year2) != 0 || count($year3) != 0){
                if(count($year4) != 0){
                    $year4 = range(37,max($year4));
                }else{
                    $year4 = [];
                }
            }else{
                if(count($year4) != 0){
                    $year4 = range(min($year4),max($year4));
                }else{
                    $year4 = [];
                }
            }
            $allyears = array(count($year1), count($year2), count($year3), count($year4));
        }

        $_fulltbpprojectplans =  FullTbpProjectPlan::where('full_tbp_id',$request->id)->orderBy('itemorder','asc')->get();
        $arr = array();
        foreach ($_fulltbpprojectplans as $key => $_fulltbpprojectplan) {
            $_count = 1;
               for($i = $minmonth; $i <= $maxmonth; $i++){
                $_count++;	
                    $check = $_fulltbpprojectplan->fulltbpprojectplantransaction->where('month',$i)->first();
                    if (!Empty($check)) {
                        $color = 'grey';
                         $arr[] = array('fulltbpid' => $check->full_tbp_id,'planid' => $_fulltbpprojectplan->id ,'row' => $key + 1 , 'month' => intVal($i) ); 
                    }
                   
               }
           }
           if(count($arr) > 0){
                usort($arr, array( $this, 'invenDescSort' ));
                $ganttarr = array();
                $count = 1;
                $flag = false;
                foreach ($arr as $key => $value){
                    $check = FullTbpProjectPlanTransaction::where('full_tbp_id',$arr[$key]['fulltbpid'])->where('project_plan_id',$arr[$key]['planid'])->where('month',$arr[$key]['month'])->first();
                    if(!Empty($check)){
                        $check->update([
                            'mindex' => $count
                        ]);
                    }
                    $ganttarr[] = array('fulltbpid' => $arr[$key]['fulltbpid'],'planid' => $arr[$key]['planid'],'key' => $count , 'row' => $arr[$key]['row'] , 'month' => $arr[$key]['month'] ); 
        
                    $count ++;
                    if($key < count($arr)-1){
                        if($arr[$key]['month'] == $arr[$key+1]['month']){
                            $count --;
                        }
                    }
                }
           }

           $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();
        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions,
            "minmonth" => $minmonth,
            "maxmonth" => $maxmonth,
            "allyears" => $allyears
        ));
    }

    public function AddMonth(Request $request){

        $fulltbpid = $request->id;
        if($request->flag == 2){
            FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->delete();
            FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbpid)->delete();
        }
        FullTbpGantt::where('full_tbp_id',$fulltbpid)->first()->update([
            'numofmonth' => $request->numofmonth,
        ]);

        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->orderBy('itemorder','asc')->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->pluck('id')->toArray();
        
        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbpid)->distinct('month')->pluck('month')->toArray();
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0,0);
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
            $year4 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 37 && $n <= 48;
            });

            //=====new method check year one
            if(count($year1) != 0){
                if(count($year2) != 0 || count($year3) != 0 || count($year4) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }

            //===== new method check year two
            if(count($year1) != 0){
                if(count($year3) != 0 || count($year4) != 0){
                        $year2 = range(13,24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(13,max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }else{
                if(count($year3) != 0 || count($year4) != 0){
                    $year2 = range(min($year2),24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(min($year2),max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }

            
            //==== year three

            if(count($year1) != 0 || count($year2) != 0){
                if(count($year4) != 0){
                    $year3 = range(25,36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(25,max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }else{
                if(count($year4) != 0){
                    $year3 = range(min($year3),36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(min($year3),max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }

            //===== new method check year foure
            if(count($year1) != 0 || count($year2) != 0 || count($year3) != 0){
                if(count($year4) != 0){
                    $year4 = range(37,max($year4));
                }else{
                    $year4 = [];
                }
            }else{
                if(count($year4) != 0){
                    $year4 = range(min($year4),max($year4));
                }else{
                    $year4 = [];
                }
            }
            $allyears = array(count($year1), count($year2), count($year3), count($year4));
        }

        $_fulltbpprojectplans =  FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->orderBy('itemorder','asc')->get();
        $arr = array();
        foreach ($_fulltbpprojectplans as $key => $_fulltbpprojectplan) {
            $_count = 1;
               for($i = $minmonth; $i <= $maxmonth; $i++){
                $_count++;	
                    $check = $_fulltbpprojectplan->fulltbpprojectplantransaction->where('month',$i)->first();
                    if (!Empty($check)) {
                        $color = 'grey';
                         $arr[] = array('fulltbpid' => $check->full_tbp_id,'planid' => $_fulltbpprojectplan->id ,'row' => $key + 1 , 'month' => intVal($i) ); 
                    }
                   
               }
           }
    
           if(count($arr) > 0){
                usort($arr, array( $this, 'invenDescSort' ));
                $ganttarr = array();
                $count = 1;
                $flag = false;
                foreach ($arr as $key => $value){
                    $check = FullTbpProjectPlanTransaction::where('full_tbp_id',$arr[$key]['fulltbpid'])->where('project_plan_id',$arr[$key]['planid'])->where('month',$arr[$key]['month'])->first();
                    if(!Empty($check)){
                        $check->update([
                            'mindex' => $count
                        ]);
                    }
                    $ganttarr[] = array('fulltbpid' => $arr[$key]['fulltbpid'],'planid' => $arr[$key]['planid'],'key' => $count , 'row' => $arr[$key]['row'] , 'month' => $arr[$key]['month'] ); 
        
                    $count ++;
                    if($key < count($arr)-1){
                        if($arr[$key]['month'] == $arr[$key+1]['month']){
                            $count --;
                        }
                    }
                }
           }

           $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();
        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions,
            "minmonth" => $minmonth,
            "maxmonth" => $maxmonth,
            "allyears" => $allyears
        ));

    }
    public  function invenDescSort($item1,$item2)
    {
        if ($item1['month'] == $item2['month']) return 0;
        return ($item1['month'] > $item2['month']) ? 1 : -1;
    }
    public function Get(Request $request){
        $fulltbpprojecplan = FullTbpProjectPlan::find($request->id);
       
        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbpprojecplan->full_tbp_id)->distinct('month')->pluck('month')->toArray();
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0,0);
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
            $year4 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 37 && $n <= 48;
            });

            //=====new method check year one
            if(count($year1) != 0){
                if(count($year2) != 0 || count($year3) != 0 || count($year4) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }

            //===== new method check year two
            if(count($year1) != 0){
                if(count($year3) != 0 || count($year4) != 0){
                        $year2 = range(13,24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(13,max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }else{
                if(count($year3) != 0 || count($year4) != 0){
                    $year2 = range(min($year2),24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(min($year2),max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }

            
            //==== year three

            if(count($year1) != 0 || count($year2) != 0){
                if(count($year4) != 0){
                    $year3 = range(25,36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(25,max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }else{
                if(count($year4) != 0){
                    $year3 = range(min($year3),36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(min($year3),max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }

            //===== new method check year foure
            if(count($year1) != 0 || count($year2) != 0 || count($year3) != 0){
                if(count($year4) != 0){
                    $year4 = range(37,max($year4));
                }else{
                    $year4 = [];
                }
            }else{
                if(count($year4) != 0){
                    $year4 = range(min($year4),max($year4));
                }else{
                    $year4 = [];
                }
            }
            $allyears = array(count($year1), count($year2), count($year3), count($year4));
        }
        $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::where('project_plan_id',$request->id)->get();
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
        
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->orderBy('itemorder','asc')->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->pluck('id')->toArray();
        

        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->distinct('month')->pluck('month')->toArray();
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0,0);
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
            $year4 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 37 && $n <= 48;
            });

            //=====new method check year one
            if(count($year1) != 0){
                if(count($year2) != 0 || count($year3) != 0 || count($year4) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }

            //===== new method check year two
            if(count($year1) != 0){
                if(count($year3) != 0 || count($year4) != 0){
                        $year2 = range(13,24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(13,max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }else{
                if(count($year3) != 0 || count($year4) != 0){
                    $year2 = range(min($year2),24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(min($year2),max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }

            
            //==== year three

            if(count($year1) != 0 || count($year2) != 0){
                if(count($year4) != 0){
                    $year3 = range(25,36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(25,max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }else{
                if(count($year4) != 0){
                    $year3 = range(min($year3),36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(min($year3),max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }

            //===== new method check year foure
            if(count($year1) != 0 || count($year2) != 0 || count($year3) != 0){
                if(count($year4) != 0){
                    $year4 = range(37,max($year4));
                }else{
                    $year4 = [];
                }
            }else{
                if(count($year4) != 0){
                    $year4 = range(min($year4),max($year4));
                }else{
                    $year4 = [];
                }
            }
            $allyears = array(count($year1), count($year2), count($year3), count($year4));
        }

        $_fulltbpprojectplans =  FullTbpProjectPlan::where('full_tbp_id',$fulltbpprojectplan->full_tbp_id)->orderBy('itemorder','asc')->get();
        $arr = array();
        foreach ($_fulltbpprojectplans as $key => $_fulltbpprojectplan) {
            $_count = 1;
               for($i = $minmonth; $i <= $maxmonth; $i++){
                $_count++;	
                    $check = $_fulltbpprojectplan->fulltbpprojectplantransaction->where('month',$i)->first();
                    if (!Empty($check)) {
                        $color = 'grey';
                         $arr[] = array('fulltbpid' => $check->full_tbp_id,'planid' => $_fulltbpprojectplan->id ,'row' => $key + 1 , 'month' => intVal($i) ); 
                    }
                   
               }
           }
            if(count($arr) > 0){
                usort($arr, array( $this, 'invenDescSort' ));
                $ganttarr = array();
                $count = 1;
                $flag = false;
                foreach ($arr as $key => $value){
                     $check = FullTbpProjectPlanTransaction::where('full_tbp_id',$arr[$key]['fulltbpid'])->where('project_plan_id',$arr[$key]['planid'])->where('month',$arr[$key]['month'])->first();
                     if(!Empty($check)){
                         $check->update([
                             'mindex' => $count
                         ]);
                     }
                     $ganttarr[] = array('fulltbpid' => $arr[$key]['fulltbpid'],'planid' => $arr[$key]['planid'],'key' => $count , 'row' => $arr[$key]['row'] , 'month' => $arr[$key]['month'] ); 
         
                    $count ++;
                    if($key < count($arr)-1){
                        if($arr[$key]['month'] == $arr[$key+1]['month']){
                            $count --;
                        }
                    }
                }
            }

           $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();
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
        $fulltbpprojecplans = FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->orderBy('itemorder','asc')->get();
        $projecplanids = FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->pluck('id')->toArray();
        

        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$fulltbpid)->distinct('month')->pluck('month')->toArray();
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0,0);
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
            $year4 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 37 && $n <= 48;
            });

            //=====new method check year one
            if(count($year1) != 0){
                if(count($year2) != 0 || count($year3) != 0 || count($year4) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }

            //===== new method check year two
            if(count($year1) != 0){
                if(count($year3) != 0 || count($year4) != 0){
                        $year2 = range(13,24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(13,max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }else{
                if(count($year3) != 0 || count($year4) != 0){
                    $year2 = range(min($year2),24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(min($year2),max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }

            
            //==== year three

            if(count($year1) != 0 || count($year2) != 0){
                if(count($year4) != 0){
                    $year3 = range(25,36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(25,max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }else{
                if(count($year4) != 0){
                    $year3 = range(min($year3),36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(min($year3),max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }

            //===== new method check year foure
            if(count($year1) != 0 || count($year2) != 0 || count($year3) != 0){
                if(count($year4) != 0){
                    $year4 = range(37,max($year4));
                }else{
                    $year4 = [];
                }
            }else{
                if(count($year4) != 0){
                    $year4 = range(min($year4),max($year4));
                }else{
                    $year4 = [];
                }
            }
            $allyears = array(count($year1), count($year2), count($year3), count($year4));
        }

        $_fulltbpprojectplans =  FullTbpProjectPlan::where('full_tbp_id',$fulltbpid)->orderBy('itemorder','asc')->get();
        $arr = array();
        foreach ($_fulltbpprojectplans as $key => $_fulltbpprojectplan) {
            $_count = 1;
               for($i = $minmonth; $i <= $maxmonth; $i++){
                $_count++;	
                    $check = $_fulltbpprojectplan->fulltbpprojectplantransaction->where('month',$i)->first();
                    if (!Empty($check)) {
                        $color = 'grey';
                         $arr[] = array('fulltbpid' => $check->full_tbp_id,'planid' => $_fulltbpprojectplan->id ,'row' => $key + 1 , 'month' => intVal($i) ); 
                    }
                   
               }
           }
    
           if(count($arr) > 0){
                usort($arr, array( $this, 'invenDescSort' ));
                $ganttarr = array();
                $count = 1;
                $flag = false;
                foreach ($arr as $key => $value){
                    $check = FullTbpProjectPlanTransaction::where('full_tbp_id',$arr[$key]['fulltbpid'])->where('project_plan_id',$arr[$key]['planid'])->where('month',$arr[$key]['month'])->first();
                    if(!Empty($check)){
                        $check->update([
                            'mindex' => $count
                        ]);
                    }
                    $ganttarr[] = array('fulltbpid' => $arr[$key]['fulltbpid'],'planid' => $arr[$key]['planid'],'key' => $count , 'row' => $arr[$key]['row'] , 'month' => $arr[$key]['month'] ); 
        
                    $count ++;
                    if($key < count($arr)-1){
                        if($arr[$key]['month'] == $arr[$key+1]['month']){
                            $count --;
                        }
                    }
                }
           }

           $fulltbpprojectplantransactions = FullTbpProjectPlanTransaction::whereIn('project_plan_id',$projecplanids)->get();
        return response()->json(array(
            "fulltbpprojecplans" => $fulltbpprojecplans,
            "fulltbpprojectplantransactions" => $fulltbpprojectplantransactions,
            "minmonth" => $minmonth,
            "maxmonth" => $maxmonth,
            "allyears" => $allyears
        ));
    }
    public function updateGanttOrder(Request $request){
        foreach ($request->order as $key => $item) {
            FullTbpProjectPlan::find($item)->update([
                'itemorder' => $key+1
            ]);
        }
    }
    public function GetMonth(Request $request){
        $months= FullTbpProjectPlanTransaction::where('full_tbp_id',$request->fulltbpid)->pluck('month')->toArray();
        return response()->json($months); 
    }
    
}