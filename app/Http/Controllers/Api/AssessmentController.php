<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\FullTbpCost;
use App\Model\BusinessPlan;
use App\Model\FullTbpAsset;
use Illuminate\Http\Request;
use App\Model\FullTbpEmployee;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpSellStatus;
use App\Model\ProjectAssignment;
use App\Http\Controllers\Controller;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectCertify;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpReturnOfInvestment;
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

                $fulltbp = new FullTbp();
                $fulltbp->mini_tbp_id = $minitbp->id;
                $fulltbp->save();

                $fulltbpemployee = new FullTbpEmployee();
                $fulltbpemployee->full_tbp_id = $fulltbp->id;
                $fulltbpemployee->save();

                $fulltbpcompanyprofile = new FullTbpCompanyProfile();
                $fulltbpcompanyprofile->full_tbp_id = $fulltbp->id;
                $fulltbpcompanyprofile->save();

                $fulltbpprojectcertify = new FullTbpProjectCertify();
                $fulltbpprojectcertify->full_tbp_id = $fulltbp->id;
                $fulltbpprojectcertify->save();
                
                $sellstatus = array("ยอดขายในประเทศ", "ยอดขายส่งออก", "ยอดขายเปิด L/C(Letter of Credit) กับสถาบันการเงิน","วงเงินตามสัญญา L/C ที่มีกับสถาบันการเงิน");

                foreach ($sellstatus as $status) {
                    FullTbpSellStatus::create([
                        'full_tbp_id' => $fulltbp->id,
                        'name' => $status
                    ]);
                }
                $assets = array("ค่าที่ดิน", "ค่าอาคารและสิ่งปลูกสร้าง", "ค่าตกแต่งอาคารและสิ่งปลูกสร้าง","ค่าเครื่องจักร","ค่าคอมพิวเตอร์","อื่นๆ");
                foreach ($assets as $asset) {
                    FullTbpAsset::create([
                        'full_tbp_id' => $fulltbp->id,
                        'asset' => $asset
                    ]);
                }
                $investments = array("ค่าใช้จ่ายในการจัดตั้งธุรกิจ (กรณีเพิ่งเริ่มจัดตั้งธุรกิจ)", "ค่าใช้จ่ายในการพัฒนาเทคโนโลยีหลักที่ใช้ในกระบวนการผลิตและบริการ", "ค่าใช้จ่ายในกระบวนการผลิต (เช่น ค่าวัตถุดิบ, ค่าแรง, ค่าใช้จ่ายในการผลิต)","ค่าใช้จ่ายในการดำเนินงาน","ค่าใช้จ่ายอื่นๆ");
                foreach ($investments as $investment) {
                    FullTbpInvestment::create([
                        'full_tbp_id' => $fulltbp->id,
                        'investment' => $investment
                    ]);
                }

                $costs = array("แหล่งเงินทุนภายใน", "แหล่งเงินทุนภายนอก");
                foreach ($costs as $cost) {
                    FullTbpCost::create([
                        'full_tbp_id' => $fulltbp->id,
                        'costname' => $cost
                    ]);
                }

                $fulltbpreturnofinvestment = new FullTbpReturnOfInvestment();
                $fulltbpreturnofinvestment->full_tbp_id = $fulltbp->id;
                $fulltbpreturnofinvestment->save();

                $messagebox = new MessageBox();
                $messagebox->title = 'ขอรับการประเมินใหม่';
                $messagebox->message_priority_id = 1;
                $messagebox->body = Company::where('user_id',Auth::user()->id)->first()->name . 'ขอรับการประเมินใหม่';
                $messagebox->sender_id = Auth::user()->id;
                $messagebox->receiver_id = User::where('user_type_id',4)->first()->id;
                $messagebox->message_read_status_id = 1;
                $messagebox->save();

                EmailBox::send(User::where('user_type_id',7)->first()->email,'TTRS:ขอรับการประเมินใหม่','เรียน Master<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้สร้างรายการขอการประเมิน โปรดตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.businessplan.view',['id' => $businessplan->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
                Message::sendMessage('ขอรับการประเมินใหม่','เรียน Master<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้สร้างรายการขอการประเมิน โปรดตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.businessplan.view',['id' => $businessplan->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',7)->first()->id);
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
