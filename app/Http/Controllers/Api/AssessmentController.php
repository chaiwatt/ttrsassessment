<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;

use App\Model\Company;
use App\Model\MiniTBP;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\BusinessPlanFeeTransaction;

class AssessmentController extends Controller
{
    public function Add(Request $request){
        $businessplan = BusinessPlan::where('company_id',$request->companyid)->first();
        if(Empty($businessplan)){
            if($request->status == 1){
                $businessplan = new BusinessPlan();
                $businessplan->code = Carbon::now()->timestamp;
                $businessplan->company_id = $request->companyid;
                $businessplan->business_plan_status_id = 1;
                $businessplan->save();

                $minitbp = new MiniTBP();
                $minitbp->business_plan_id = $businessplan->id;
                $minitbp->save();

                // $businessplanfeetransaction = new BusinessPlanFeeTransaction();
                // $businessplanfeetransaction->invoiceno = Carbon::now()->timestamp;
                // $businessplanfeetransaction->business_plan_id = $businessplan->id;
                // $businessplanfeetransaction->save();

                // $messagebox = new MessageBox();
                // $messagebox->title = 'แจ้งการชำระเงินค่าธรรมเนียม';
                // $messagebox->message_priority_id = 1;
                // $messagebox->body = "<h2>โปรดตรวสอบ</h2><a href=".route('dashboard.company.fee').">คลิกเพื่อไปยังลิงค์</a>";
                // $messagebox->sender_id = User::where('user_type_id',1)->first()->id;
                // $messagebox->receiver_id = Auth::user()->id;
                // $messagebox->message_read_status_id = 1;
                // $messagebox->save();

                $messagebox = new MessageBox();
                $messagebox->title = 'ขอรับการประเมินใหม่';
                $messagebox->message_priority_id = 1;
                $messagebox->body = Company::where('user_id',Auth::user()->id)->first()->name . 'ขอรับการประเมินใหม่';
                $messagebox->sender_id = Auth::user()->id;
                $messagebox->receiver_id = User::where('user_type_id',1)->first()->id;
                $messagebox->message_read_status_id = 1;
                $messagebox->save();

                EmailBox::send(User::where('user_type_id',1)->first()->email,'ขอรับการประเมินใหม่',Company::where('user_id',Auth::user()->id)->first()->name . ' ได้สร้างรายการขอการประเมิน');

            }
        }else{
            if($request->status == 1){
                $businessplan->where('company_id',$request->companyid)->first()->update([
                    'business_plan_active_status_id' => '1'
                ]);
            }else{
                $businessplan->where('company_id',$request->companyid)->first()->update([
                    'business_plan_active_status_id' => '2'
                ]);
            }
        }
        return response()->json($businessplan);  
    }
}
