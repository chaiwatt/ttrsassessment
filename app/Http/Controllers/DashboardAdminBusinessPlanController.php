<?php

namespace App\Http\Controllers;

use App\Model\BusinessPlan;
use Illuminate\Http\Request;

class DashboardAdminBusinessPlanController extends Controller
{
    public function Index(){
        $businessplans = BusinessPlan::where('business_plan_active_status_id',1)
                                        ->where('business_plan_status_id',2)->get();
        return view('dashboard.admin.businessplan.index')->withBusinessplans($businessplans);
    }
}

