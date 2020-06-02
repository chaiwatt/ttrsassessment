<?php

namespace App\Http\Controllers;

use PDF;
use App\Model\Company;
use App\Model\BankAccount;
use App\Model\PaymentType;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\BusinessPlanFeeTransaction;

class DashboardCompanyFeeController extends Controller
{
    public function Index(){

        $businessplan = BusinessPlan::where('company_id',Company::where('user_id',Auth::user()->id)->first()->id)->first();
        $businessplanfeetransactions = BusinessPlanFeeTransaction::where('payment_status_id',1)
                                                            ->where('business_plan_id',$businessplan->id)->get();
        return view('dashboard.company.fee.index')->withBusinessplanfeetransactions($businessplanfeetransactions);
    }

    public function Invoice($id)
    {
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $body = 'แสดงรายละเอียดค่าธรรมเนียม เช่น ค่าธรรมเนียมแรกเข้า หรือค่าธรรมเนียมออก Certification โดยสามารถให้ลิงค์กับ บริการรับชำระเงินเพื่อธุรกิจ ผ่าน QR Code ได้';
        $words = $segment->get_segment_array($body);
        $text = implode("|",$words);
        $data = ['title' => 'ตัวอย่างใบแจ้งหนี้', 'body' => $text];
        $pdf = PDF::loadView('dashboard.company.fee.invoice', $data);
        return $pdf->stream('document.pdf');
    }
    public function Payment($id)
    {
        $bankaccounts = BankAccount::get();
        $businessplanfeetransaction = BusinessPlanFeeTransaction::find($id);
        $paymenttypes = PaymentType::get();
        return view('dashboard.company.fee.payment')->withBusinessplanfeetransaction($businessplanfeetransaction)
                                                                                ->withBankaccounts($bankaccounts)
                                                                                ->withPaymenttypes($paymenttypes);
    }
}
