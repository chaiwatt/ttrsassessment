<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Grade;
use App\Model\FullTbp;
use App\Model\SearchGroup;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;

class DashboardAdminSearchProjectController extends Controller
{
    public function Index(){
        $searchgroups = SearchGroup::get();
        $grades = Grade::get();
        $fulltbbs = FullTbp::get();
        $industrygroups = IndustryGroup::get();
        $years = FullTbp::get()->map(function($item){ 
                                return $item['created_at']->year+543; 
                            })->unique()->sort()->toArray();
        $leaderarray = ProjectAssignment::distinct()->pluck('leader_id');
        $leaders = User::whereIn('id',$leaderarray)->get();
        $expertarray = ExpertAssignment::distinct()->pluck('user_id');
        $experts = User::whereIn('id',$expertarray)->get();
        return view('dashboard.admin.search.project.index')->withSearchgroups($searchgroups)
                                                        ->withFulltbps($fulltbbs)
                                                        ->withYears($years)
                                                        ->withIndustrygroups($industrygroups)
                                                        ->withGrades($grades)
                                                        ->withLeaders($leaders)
                                                        ->withExperts($experts);
    }

    public function GetSearch(Request $request){
        if($request->searchid == 1){
            $fullpbts = FullTbp::whereYear('created_at', ($request->value-543))->get();
            return response()->json($fullpbts);  
        }else if($request->searchid == 2){
            $minitbpids = MiniTBP::where('project', 'like', '%' . $request->value . '%')
                        ->orWhere('projecteng', 'like', '%' . $request->value . '%')->pluck('id')->toArray();
            $fullpbts = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fullpbts);   
        }else if($request->searchid == 3){
            $fullpbts = FullTbp::where('asic', $request->value)->get();
            return response()->json($fullpbts);  
        }else if($request->searchid == 4){
            $companyids = Company::where('industry_group_id', $request->value)->pluck('id')->toArray();
            $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fullpbts = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fullpbts); 
        }else if($request->searchid == 5){
            dd('search grade');
        }else if($request->searchid == 6){
            dd('search certify');
        }else if($request->searchid == 7){
            $userids = User::where('name', 'like', '%' . $request->value . '%')
                        ->orWhere('lastname', 'like', '%' . $request->value . '%')->pluck('id')->toArray();
            $businessplanids = ProjectAssignment::whereIn('leader_id', $userids)->pluck('business_plan_id')->toArray();
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fullpbts = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fullpbts); 
        }else if($request->searchid == 8){
            $userids = User::where('name', 'like', '%' . $request->value . '%')
                        ->orWhere('lastname', 'like', '%' . $request->value . '%')->pluck('id')->toArray();
            $fullpbtids = ExpertAssignment::whereIn('user_id', $userids)->pluck('full_tbp_id')->toArray();
            $fullpbts = FullTbp::whereIn('id', $fullpbtids)->get();
            return response()->json($fullpbts); 
        }else if($request->searchid == 9){
            $tmp = explode("/", $request->value);
            $minitbpids = MiniTBP::whereDay('created_at', '=', date($tmp[0]))
                                ->whereMonth('created_at', '=', date($tmp[1]))
                                ->whereYear('created_at', '=', date(($tmp[2]-543)))->pluck('id')->toArray();
            $fullpbts = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fullpbts); 
        }else if($request->searchid == 10){
            $tmp = explode("/", $request->value);
            $fullpbts = FullTbp::whereDay('created_at', '=', date($tmp[0]))
                                ->whereMonth('created_at', '=', date($tmp[1]))
                                ->whereYear('created_at', '=', date(($tmp[2]-543)))->get();
            return response()->json($fullpbts); 
        }else if($request->searchid == 11){
            dd('search assessment date');
        }
    }
}
