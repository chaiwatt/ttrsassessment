<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\FullTbpCost;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\FullTbpAsset;
use App\Model\FullTbpGantt;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\FullTbpEmployee;
use App\Model\EvaluationResult;
use App\Model\FullTbpCompanyDoc;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpSellStatus;
use App\Model\NotificationBubble;
use App\Http\Controllers\Controller;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectCertify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Model\FullTbpReturnOfInvestment;
use App\Model\FullTbpCompanyProfileAttachment;

class BusinessPlanController extends Controller
{
    public function Update(Request $request){
        $status = 1;
        $auth = Auth::user();
        if($request->status == 1){
            $status = 2;
            $_businessplan = BusinessPlan::find($request->id);
            $_company = Company::find($_businessplan->company_id);
            $_user = User::find($_company->user_id);
            $minitbp = MiniTBP::where('business_plan_id', $_businessplan->id)->first();
            $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
            $projectmember = ProjectMember::where('full_tbp_id',$fulltbp->id)
                                        ->where('user_id',$auth->id)->first();
            if(Empty($projectmember)){
                $projectmember = new ProjectMember();
                $projectmember->full_tbp_id = $fulltbp->id;
                $projectmember->user_id = $auth->id;
                $projectmember->save();
            }
            
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $request->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 4;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $_user->id;
            $notificationbubble->save();

            $messagebox =  Message::sendMessage('กรอกข้อมูล Mini TBP','คำขอประเมินธุรกิจได้ผ่านการอนุมัติ สามารถกรอกข้อมูล Mini TBP ได้ที่ <a href='.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a>',User::where('user_type_id',6)->first()->id,$_user->id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $_user->id;           
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detailDateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' คำขอประเมินธุรกิจได้รับอนุมัติให้สามารถกรอกข้อมูล Mini TBP ได้  ' ;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
            
            EmailBox::send($_user->email,'','TTRS: กรอกข้อมูล Mini TBP โครงการ' . $minitbp->project,'เรียน ผู้ขอรับการประเมิน<br><br> คำขอประเมินธุรกิจได้ผ่านการอนุมัติ ให้สามารถกรอกข้อมูล Mini TBP ได้ที่ <a href='.route('dashboard.company.project.minitbp.edit',['id' => $minitbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            

        }
        BusinessPlan::find($request->id)->update([
            'business_plan_status_id' => $status
        ]);
        $businessplan = BusinessPlan::find($request->id);  
        return response()->json($businessplan);  
    }

    public function CreateProject(Request $request){
            $count = BusinessPlan::get()->count() + 1;
            $auth = Auth::user();
            $company = Company::where('user_id',$auth->id)->first();
            $businessplan = new BusinessPlan();
            $businessplan->code = Carbon::now()->format('y') . Carbon::now()->format('m') . str_pad(($count),3,0,STR_PAD_LEFT); 
            $businessplan->company_id = $company->id;
            $businessplan->business_plan_status_id = 2;
            $businessplan->save();

            $minitbp = new MiniTBP();
            $minitbp->business_plan_id = $businessplan->id;
            $minitbp->project = $request->projectname;
            $minitbp->contactname = $auth->name;
            $minitbp->contactprefix = $auth->prefix_id;
            $minitbp->contactposition = $auth->position;
            $minitbp->contactlastname = $auth->lastname;
            $minitbp->contactemail = $auth->email;
            $minitbp->contactphone = $auth->phone;
            $minitbp->website = $company->website;  
            $minitbp->save();

            $fulltbp = new FullTbp();
            $fulltbp->mini_tbp_id = $minitbp->id;
            $fulltbp->save();

            $fulltbpgantt = new FullTbpGantt();
            $fulltbpgantt->full_tbp_id = $fulltbp->id;
            $fulltbpgantt->startyear = intval(Carbon::now()->year) + 543 ;
            $fulltbpgantt->save();
            
            $fulltbpcompanydocs = FullTbpCompanyDoc::where('company_id',$company->id)->get();
           
            if($fulltbpcompanydocs->count() > 0){
                
                foreach ($fulltbpcompanydocs as $key => $fulltbpcompanydoc) {
                    $filename = basename($fulltbpcompanydoc->path); 
                    File::copy(public_path($fulltbpcompanydoc->path),public_path("storage/uploads/fulltbp/companyprofile/attachment/".$filename));
                    $fulltbpcompanyprofileattachment = new FullTbpCompanyProfileAttachment();
                    $fulltbpcompanyprofileattachment->full_tbp_id = $fulltbp->id;
                    $fulltbpcompanyprofileattachment->path = "storage/uploads/fulltbp/companyprofile/attachment/".$filename;
                    $fulltbpcompanyprofileattachment->name = $fulltbpcompanydoc->name;
                    $fulltbpcompanyprofileattachment->save();
                }
            }
          
            $ev = new Ev();
            $ev->full_tbp_id = $fulltbp->id;
            $ev->save();

            $evaluationresult = new EvaluationResult();
            $evaluationresult->full_tbp_id = $fulltbp->id;
            $evaluationresult->save();

            $fulltbpemployee = new FullTbpEmployee();
            $fulltbpemployee->full_tbp_id = $fulltbp->id;
            $fulltbpemployee->save();

            $fulltbpcompanyprofile = new FullTbpCompanyProfile();
            $fulltbpcompanyprofile->full_tbp_id = $fulltbp->id;
            $fulltbpcompanyprofile->save();

            $fulltbpprojectcertify = new FullTbpProjectCertify();
            $fulltbpprojectcertify->full_tbp_id = $fulltbp->id;
            $fulltbpprojectcertify->save();

            $projectmember = ProjectMember::where('full_tbp_id',$fulltbp->id)
                                        ->where('user_id',$auth->id)->first();
            // if(Empty($projectmember)){
            //     $projectmember = new ProjectMember();
            //     $projectmember->full_tbp_id = $fulltbp->id;
            //     $projectmember->user_id = User::where('user_type_id',5)->first()->id;
            //     $projectmember->save();

            //     $projectmember = new ProjectMember();
            //     $projectmember->full_tbp_id = $fulltbp->id;
            //     $projectmember->user_id = User::where('user_type_id',6)->first()->id;
            //     $projectmember->save();
            // }
            
            $sellstatus = array("1. ยอดขายในประเทศ", "2. ยอดขายส่งออก", "  -  ยอดขายเปิด L/C (Letter of Credit) กับสถาบันการเงิน","  -  วงเงินตามสัญญา L/C ที่มีกับสถาบันการเงิน");
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
    }
}
