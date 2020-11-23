<?php

namespace App\Http\Controllers\Api;
use PDF;
use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\FullTbpEmployee;
use App\Model\ProjectAssignment;
use App\Model\CompanyStockHolder;
use App\Model\NotificationBubble;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpCompanyProfileDetail;

class FullTbpController extends Controller
{

    public function GeneratePdf(Request $request){
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $fulltbp = FullTbp::find($request->id);
        $fulltbpcode = $fulltbp->fulltbp_code;
        if(Empty($fulltbpcode)){
            $fulltbpcode = Carbon::now()->format('y') . Carbon::now()->format('m') . str_pad((FullTbp::get()->count()),3,0,STR_PAD_LEFT); 
            FullTbp::find($request->id)->update([
                'fulltbp_code' => $fulltbpcode
            ]);
        }
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $ceo = CompanyEmploy::where('full_tbp_id',$request->id)->where('employ_position_id',1)->first();
        $companyboards = CompanyEmploy::where('full_tbp_id',$request->id)->where('employ_position_id','<=',5)->where('id','!=',$ceo->id)->get();
        $companyemploys = CompanyEmploy::where('full_tbp_id',$request->id)->where('employ_position_id','>',5)->where('id','!=',$ceo->id)->get();
        $companyhistory = $segment->get_segment_array($company->companyhistory);
        $companystockholders = CompanyStockHolder::where('company_id',$company->id)->get();
        $data = [
            'fulltbp' => $fulltbp,
            'companyboards' => $companyboards,
            'companyemploys' => $companyemploys,
            'companystockholders' => $companystockholders,
            'companyhistory' => $companyhistory
        ];
        $pdf = PDF::loadView('dashboard.company.project.fulltbp.pdf', $data);
        $path = public_path("storage/uploads/");
        $pdf->save($path.$fulltbpcode.'.pdf');
        return 'storage/uploads/'.$fulltbpcode.'.pdf' ;
    }
    
    public function EditSignature(Request $request){
        $fulltbp = FullTbp::find($request->id)->update([
            'signature_status_id' => $request->usesignature
        ]);
    }
    public function SubmitWithAttachement(Request $request){
        $auth = Auth::user();
        $fulltbp = FullTbp::find($request->id);
        if(!Empty($fulltbp->attachment)){
            @unlink($fulltbp->attachment);
        }
        $file = $request->attachment;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/pdf/attachment" , $new_name);
        $filelocation = "storage/uploads/pdf/attachment/".$new_name;
        $fulltbp->update([
            'attachment' => $filelocation,
            'status' => 2
        ]);
        
        $message = 'แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)' ;
        $fulltbp = FullTbp::find($request->id);
        if($fulltbp->refixstatus == 1){
            $fulltbp->update([
                'refixstatus' => 2  
            ]);
            $message = 'แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ที่มีการแก้ไข' ;
        }

        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 5
        ]);

        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->detail = 'โครงการ' . MiniTBP::find($fulltbp->mini_tbp_id)->project . ' ได้ส่ง'.$message.' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:'.$message,'เรียน Leader<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
        EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:'.$message,'เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');

        Message::sendMessage('ส่ง'.$message,'เรียน Leader<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::find($projectassignment->leader_id)->id);
        Message::sendMessage('ส่ง'.$message,'เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',6)->first()->id);
        
    }
    
    public function SubmitWithNoAttachement(Request $request){
        $auth = Auth::user();
        $fulltbp = FullTbp::find($request->id);
        $filelocation = "storage/uploads/".$fulltbp->fulltbp_code.'.pdf';

        $fulltbp->update([
            'attachment' => $filelocation
        ]);
        
        $message = 'แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP)' ;
        $fulltbp = FullTbp::find($request->id);
        if($fulltbp->refixstatus == 1){
            $fulltbp->update([
                'refixstatus' => 2  
            ]);
            $message = 'แบบฟอร์มแผนธุรกิจเทคโนโลยี (Full TBP) ที่มีการแก้ไข' ;
        }

        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 5
        ]);

        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->detail = 'โครงการ' . MiniTBP::find($fulltbp->mini_tbp_id)->project . ' ได้ส่ง'.$message.' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:'.$message,'เรียน Leader<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
        EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:'.$message,'เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');

        Message::sendMessage('ส่ง'.$message,'เรียน Leader<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::find($projectassignment->leader_id)->id);
        Message::sendMessage('ส่ง'.$message,'เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.fulltbp').'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',6)->first()->id);
        
    }
}
