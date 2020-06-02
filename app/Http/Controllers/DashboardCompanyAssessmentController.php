<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCompanyAssessmentController extends Controller
{
    public function Index(){
        $businessplans = BusinessPlan::where('company_id',Company::where('user_id',Auth::user()->id)->first()->id)->get();
        return view('dashboard.company.assessment.index')->withBusinessplans($businessplans);
    }
}
