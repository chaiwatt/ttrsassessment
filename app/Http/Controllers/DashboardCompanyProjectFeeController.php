<?php

namespace App\Http\Controllers;

use PDF;
use App\User;
use App\Model\Company;
use App\Model\MessageBox;
use App\Model\BankAccount;
use App\Model\PaymentType;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use Illuminate\Support\Facades\Auth;
use App\Model\BusinessPlanFeeTransaction;
use App\Http\Requests\SaveDashboardCompanyFeeRequest;

class DashboardCompanyProjectFeeController extends Controller
{
    public function Index(){

        $businessplan = BusinessPlan::where('company_id',Company::where('user_id',Auth::user()->id)->first()->id)->first();
        $businessplanfeetransactions = BusinessPlanFeeTransaction::where('payment_status_id',1)
                                                            ->where('business_plan_id',$businessplan->id)->get();
        return view('dashboard.company.project.fee.index')->withBusinessplanfeetransactions($businessplanfeetransactions);
    }

    public function Invoice($id)
    {
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $body = 'แสดงรายละเอียดค่าธรรมเนียม เช่น ค่าธรรมเนียมแรกเข้า หรือค่าธรรมเนียมออก Certification โดยสามารถให้ลิงก์กับ บริการรับชำระเงินเพื่อธุรกิจ ผ่าน QR Code ได้';
        $words = $segment->get_segment_array($body);
        $text = implode("|",$words);
        $data = ['title' => 'ตัวอย่างใบแจ้งหนี้', 'body' => $text];
        $pdf = PDF::loadView('dashboard.company.project.fee.invoice', $data);
        return $pdf->stream('document.pdf');
    }
    public function Payment($id)
    {
        $bankaccounts = BankAccount::get();
        $businessplanfeetransaction = BusinessPlanFeeTransaction::find($id);
        $paymenttypes = PaymentType::get();
        return view('dashboard.company.project.fee.payment')->withBusinessplanfeetransaction($businessplanfeetransaction)
                                                                                ->withBankaccounts($bankaccounts)
                                                                                ->withPaymenttypes($paymenttypes);
    }
    public function PaymentSave(SaveDashboardCompanyFeeRequest $request,$id){
        $filelocation ="";
        $file = $request->attachment;
        if(!Empty($file)){
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/fee" , $new_name);
            $filelocation = "storage/uploads/fee/".$new_name;
        }

        BusinessPlanFeeTransaction::find($id)->update([
            'payment_status_id' => 2,
            'transferdate' => DateConversion::thaiToEngDate($request->paymentdate),
            'transfertime' => $request->paymenttime,
            'bank_account_id' => $request->bankaccount,
            'payment_type_id' => $request->paymenttype,
            'attachment' => $filelocation,
            'note' => $request->note
        ]);

        $messagebox = new MessageBox();
        $messagebox->title = 'แจ้งการชำระเงินค่าธรรมเนียม';
        $messagebox->message_priority_id = 1;
        $messagebox->body = "<h2>โปรดตรวสอบ</h2><a href=''>คลิกเพื่อไปยังลิงก์</a>";
        $messagebox->sender_id = Auth::user()->id;
        $messagebox->receiver_id = User::where('user_type_id',4)->first()->id;
        $messagebox->message_read_status_id = 1;
        $messagebox->save();

        return redirect()->back()->withSuccess('แจ้งการชำระเงินเรียบร้อยแล้ว');
    }
}
