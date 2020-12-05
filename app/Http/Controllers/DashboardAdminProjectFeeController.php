<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessPlanFeeTransaction;

class DashboardAdminProjectFeeController extends Controller
{
    public function Index(){
        $invoicetransactions = InvoiceTransaction::where('payment_status_id',1)->get();
        return view('dashboard.admin.project.invoice.index')->withInvoicetransactions($invoicetransactions);
    }
}
