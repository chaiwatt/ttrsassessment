<?php

namespace App\Http\Controllers;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Model\ThaiBank;
use App\Model\BusinessPlan;
use App\Model\UserPosition;
use Illuminate\Http\Request;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardAdminMiniTbpController extends Controller
{
    public function Index(){
        $projectassignments = ProjectAssignment::where('leader_id',Auth::user()->id)->pluck('business_plan_id')->toArray();
        $businessplans = BusinessPlan::where('business_plan_status_id',3)->whereIn('id',$projectassignments)->pluck('id')->toArray();
        if(Auth::user()->user_type_id >= 7){
            $businessplans = BusinessPlan::where('business_plan_status_id',3)->pluck('id')->toArray();
        }
        $minitbps = MiniTBP::whereIn('business_plan_id',$businessplans)->get();
        return view('dashboard.admin.minitbp.index')->withMinitbps($minitbps);
    }

    public function View($id){
        $banks = ThaiBank::get();
        $minitbp = MiniTBP::find($id);
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        return view('dashboard.admin.minitbp.view')->withMinitbp($minitbp)
                                                ->withBanks($banks)
                                                ->withContactprefixes($contactprefixes)
                                                ->withContactpositions($contactpositions);
    }
    public function Approve($id){
        $minitbp = MiniTBP::find($id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 4
        ]);
        return redirect()->back()->withSuccess('ยืนยัน mini TBP สำเร็จ');
    }
}
