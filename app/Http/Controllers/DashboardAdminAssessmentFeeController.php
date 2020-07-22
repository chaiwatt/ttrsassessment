<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessPlanFeeTransaction;

class DashboardAdminAssessmentFeeController extends Controller
{
    public function Index(){
        $businessplanfeetransactions = BusinessPlanFeeTransaction::where('payment_status_id',1)->get();
        return view('dashboard.admin.assessment.fee.index')->withBusinessplanfeetransactions($businessplanfeetransactions);
    }
}
