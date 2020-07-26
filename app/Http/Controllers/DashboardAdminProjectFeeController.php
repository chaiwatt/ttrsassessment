<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessPlanFeeTransaction;

class DashboardAdminProjectFeeController extends Controller
{
    public function Index(){
        $businessplanfeetransactions = BusinessPlanFeeTransaction::where('payment_status_id',1)->get();
        return view('dashboard.admin.project.fee.index')->withBusinessplanfeetransactions($businessplanfeetransactions);
    }
}
