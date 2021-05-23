<?php

namespace App\Http\Controllers\Api;
use PDF;
use App\User;
use ZipArchive;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\GeneralInfo;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\FullTbpGantt;
use App\Model\CompanyEmploy;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Model\FullTbpEmployee;
use App\Model\TimeLineHistory;
use App\Model\FullTbpSignature;
use App\Model\ProjectAssignment;
use App\Model\StockHolderEmploy;
use App\Model\CompanyStockHolder;
use App\Model\FullTbpProjectPlan;
use App\Model\NotificationBubble;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Model\ProjectStatusTransaction;
use App\Model\FullTbpCompanyProfileDetail;
use App\Model\FullTbpProjectPlanTransaction;
use App\Model\FullTbpCompanyProfileAttachment;

class FullTbpController extends Controller
{
    public function GeneratePdf(Request $request){
        
        require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        $segment = new \Segment();
        $fulltbp = FullTbp::find($request->id);
        $fulltbpcode = $fulltbp->fulltbp_code;
        if(Empty($fulltbpcode)){
            $fulltbpcode = Carbon::now()->format('y') . Carbon::now()->format('m') . str_pad(($request->id),3,0,STR_PAD_LEFT); 
            FullTbp::find($request->id)->update([
                'fulltbp_code' => $fulltbpcode
            ]);
        }
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $ceo = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id',1)->first();
        $companyboards = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id','<=',5)->where('id','!=',@$ceo->id)->get();

        $companyemploys = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id','>',5)->where('id','!=',@$ceo->id)->get();
        $companyhistory = $segment->get_segment_array($company->companyhistory);
        $companystockholders = StockHolderEmploy::where('company_id',$company->id)->get();

        $fulltbpgantt = FullTbpGantt::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpprojectplantransactionarray =  FullTbpProjectPlanTransaction::where('full_tbp_id',$request->id)->distinct('month')->pluck('month')->toArray();
        
        $minmonth = 0;
        $maxmonth = 0;
        $allyears = array(0, 0, 0);
        if(count($fulltbpprojectplantransactionarray) != 0){
            $minmonth = min($fulltbpprojectplantransactionarray);
            $maxmonth = max($fulltbpprojectplantransactionarray);
            $year1 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 1 && $n <= 12;
            }); 
            $year2 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 13 && $n <= 24;
            });
            $year3 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 25 && $n <= 36;
            });
            if(count($year1) != 0){
                if(count($year2) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }
            
            if(count($year2) != 0){
                if(count($year1) != 0){
                    $year2 = range(13,max($year2));
                }else{
                    $year2 = range(min($year2),max($year2));
                }
            }else{
                $year2 = [];
            }
            if(count($year3) != 0){
                if(count($year2) != 0){
                    $year3 = range(25,max($year3));
                }else{
                    $year3 = range(min($year3),max($year3));
                }
            }else{
                $year3 = [];
            }
            $allyears = array(count($year1), count($year2), count($year3));
        }
        $companystockholders = StockHolderEmploy::where('company_id',$company->id)->get();
        $fulltbpprojectplans =  FullTbpProjectPlan::where('full_tbp_id',$request->id)->get();
        $fulltbpgant =  FullTbpGantt::where('full_tbp_id',$request->id)->first();
        $fulltbpsignatures = FullTbpSignature::where('full_tbp_id',$request->id)->orderBy('employ_position_id','asc')->get();
        $data = [
            'fulltbp' => $fulltbp,
            'companyboards' => $companyboards,
            'companyemploys' => $companyemploys,
            'companystockholders' => $companystockholders,
            'companyhistory' => $companyhistory,
            'minmonth' => $minmonth,
            'maxmonth' => $maxmonth,
            'allyears' => $allyears,
            'fulltbpgantt' => $fulltbpgantt,
            'fulltbpprojectplans' => $fulltbpprojectplans,
            'fulltbpsignatures' => $fulltbpsignatures,
            'fulltbpgant' => $fulltbpgant
        ];

        $generalinfo = GeneralInfo::first();
        if($generalinfo->watermark == 1){
            $pdf = PDF::loadView('dashboard.company.project.fulltbp.pdf',$data,[],[
                'watermark' => $generalinfo->watermarktext,
                'show_watermark' => true
            ]);
        }else{
            $pdf = PDF::loadView('dashboard.company.project.fulltbp.pdf',$data,[],[
                'watermark' => 'เอกสารสำคัญปกปิด (Private & Confidential)',
                'show_watermark' => false
            ]);
        }

        $shortpdf = PDF::loadView('dashboard.company.project.fulltbp.shortpdf',$data,[],[
            'watermark' => 'เอกสารสำคัญปกปิด (Private & Confidential)',
            'show_watermark' => false
        ]);

      
        $path = public_path("storage/uploads/");
        $randname = str_random(10);
        $shortpdf->save($path.$randname.'_shortdetail.pdf');
        $pdf->save($path.$randname.'.pdf');
        FullTbp::find($request->id)->update([
            'shortpdf' => 'storage/uploads/' . $randname.'_shortdetail.pdf'
        ]);
        return 'storage/uploads/'.$randname.'.pdf' ;
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
        $file->move("storage/uploads/company/attachment" , $new_name);
        $filelocation = "storage/uploads/company/attachment/".$new_name;
        $fulltbp->update([
            'attachment' => $filelocation,
            'status' => 2,
            'submitdate' => Carbon::now()->toDateString() 
        ]);
        
        $fulltbp = FullTbp::find($request->id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $message = 'แผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project ;
        if($fulltbp->refixstatus == 1){
            $fulltbp->update([
                'refixstatus' => 2  
            ]);
            $message = 'แผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project. 'ที่มีการแก้ไข' ;
        }

        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 5
        ]);

        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $company = Company::where('user_id',Auth::user()->id)->first();

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $businessplan->id;
        $timeLinehistory->details = 'ส่งแผนธุรกิจเทคโนโลยี (Full TBP)';
        $timeLinehistory->message_type = 2;
        $timeLinehistory->owner_id = $auth->id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        $messagebox = Message::sendMessage($message . ' บริษัท'. $company->name,'บริษัท'. $company->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,User::find($projectassignment->leader_id)->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' บริษัท'. $company->name .' ได้ส่ง'.$message.' กรุณาตรวจสอบ <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a> ';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:'.$message . ' บริษัท'. $company->name,'เรียน Leader<br><br> บริษัท'. $company->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success">คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        Ev::where('full_tbp_id',$request->id)->first()->update([
            'name' => $minitbp->project
        ]);

        CreateUserLog::createLog('ส่ง' . $message);

    }
    
    public function SubmitWithNoAttachement(Request $request){
        $auth = Auth::user();
        $fulltbp = FullTbp::find($request->id);
        $filelocation = $request->pdfname;

        $fulltbp->update([
            'attachment' => $filelocation,
            'submitdate' => Carbon::now()->toDateString()
        ]);
        
        $fulltbp = FullTbp::find($request->id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $message = 'แผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project ;
        if($fulltbp->refixstatus == 1){
            $fulltbp->update([
                'refixstatus' => 2  
            ]);
            $message = 'แผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project. 'ที่มีการแก้ไข' ;
        }

        
        BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 5
        ]);

        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $company = Company::where('user_id',Auth::user()->id)->first();
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $businessplan->id;
        $timeLinehistory->details = 'ส่งแผนธุรกิจเทคโนโลยี (Full TBP)';
        $timeLinehistory->message_type = 2;
        $timeLinehistory->owner_id = $auth->id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        $messagebox = Message::sendMessage($message . ' บริษัท'. $company->name,'บริษัท'. $company->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',$auth->id,User::find($projectassignment->leader_id)->id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' บริษัท'. $company->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>  ';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:'.$message . ' บริษัท'. $company->name,'เรียน Leader<br><br> บริษัท'. $company->name . ' ได้ส่ง'.$message.' กรุณาตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success">คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature()); 
        
        Ev::where('full_tbp_id',$request->id)->first()->update([
            'name' => $minitbp->project
        ]);

        CreateUserLog::createLog('ส่ง' . $message);
    }


    public function FinishOnsite(Request $request){
       $auth = Auth::user();
       FullTbp::find($request->id)->update([
           'finished_onsite' => 2
       ]);

       $fulltbp = FullTbp::find($request->id);
       $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
       $businessplan = BusinessPlan::find($minitbp->business_plan_id);
       $company = Company::find($businessplan->company_id);
       $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
       $projectmembers = ProjectMember::where('full_tbp_id',$request->id)->get();
       $membermails = array();
        foreach($projectmembers as $projectmember){
            $user = User::find($projectmember->user_id);
            $messagebox =  Message::sendMessage('ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว สำหรับโครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'Leader ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว สำหรับโครงการ' . $minitbp->project . ' บริษัท' . $company->name . 'กรุณาเตรียมพร้อมในการลงคะแนน ในขั้นตอนต่อไป',Auth::user()->id,$user->id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =  $user->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' Leader ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว สำหรับโครงการ' . $minitbp->project . ' บริษัท' . $company->name ;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $membermails[] = $user->email;
        }

        EmailBox::send($membermails,'TTRS:ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว สำหรับโครงการ' . $minitbp->project . ' บริษัท' . $company->name,'เรียน ผู้เชี่ยวชาญ<br><br> Leader ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว สำหรับโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' กรุณาเตรียมพร้อมในการลงคะแนน ในขั้นตอนต่อไป <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
       
        $messagebox =  Message::sendMessage('สร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project . ' บริษัท' . $company->name , 'กรุณาสร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a href='.route('dashboard.admin.calendar').'>คลิกที่นี่</a>',Auth::user()->id,$projectassignment->leader_id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' สร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project . ' บริษัท' . $company->name ;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:สร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project . ' บริษัท' . $company->name,'เรียน Leader<br><br> ท่านได้ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว กรุณาสร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project . ' บริษัท' . $company->name . 'โปรดตรวจสอบ <a href='.route('dashboard.admin.calendar').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',4)->first();
        if($projectstatustransaction->status == 1){
            $projectstatustransaction->update([
                'status' => 2
            ]);
            $projectstatustransaction = new ProjectStatusTransaction();
            $projectstatustransaction->mini_tbp_id = $minitbp->id;
            $projectstatustransaction->project_flow_id = 5;
            $projectstatustransaction->save();

            DateConversion::addExtraDay($minitbp->id,4);
        }
        CreateUserLog::createLog('ยืนยันการลงพื้นที่ โครงการ' . $minitbp->project);
    }

}
