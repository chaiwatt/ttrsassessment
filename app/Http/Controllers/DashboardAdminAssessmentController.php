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
        return view('dashboard.admin.assessment.index')->withFulltbps($fulltbps);
    }
   public function Edit($id){
    return $id;
   }
}
