<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessPlanFeeTransaction;

class DashboardAdminFeeController extends Controller
{
    public function Index(){
        $businessplanfeetransactions = BusinessPlanFeeTransaction::where('payment_status_id',1)->get();
        return view('dashboard.admin.fee.index')->withBusinessplanfeetransactions($businessplanfeetransactions);
    }
}
