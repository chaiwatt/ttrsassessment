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
use App\Helper\UserArray;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\GeneralInfo;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\FullTbpGantt;
use App\Model\CompanyEmploy;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\FullTbpHistory;
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
        $allyears = array(0, 0, 0,0);
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
            $year4 = array_filter($fulltbpprojectplantransactionarray, function($n){ 
                return $n >= 37 && $n <= 48;
            });

            //=====new method check year one
            if(count($year1) != 0){
                if(count($year2) != 0 || count($year3) != 0 || count($year4) != 0){
                    $year1 = range(min($year1),12);
                }else{
                    $year1 = range(min($year1),max($year1));
                }
            }else{
                $year1 = [];
            }

            //===== new method check year two
            if(count($year1) != 0){
                if(count($year3) != 0 || count($year4) != 0){
                        $year2 = range(13,24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(13,max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }else{
                if(count($year3) != 0 || count($year4) != 0){
                    $year2 = range(min($year2),24);
                }else{
                    if(count($year2) != 0){
                        $year2 = range(min($year2),max($year2));
                    }else{
                        $year2 = [];
                    }
                }
            }

            
            //==== year three

            if(count($year1) != 0 || count($year2) != 0){
                if(count($year4) != 0){
                    $year3 = range(25,36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(25,max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }else{
                if(count($year4) != 0){
                    $year3 = range(min($year3),36);
                }else{
                    if(count($year3) != 0){
                        $year3 = range(min($year3),max($year3));
                    }else{
                        $year3 = [];
                    }
                }

            }

            //===== new method check year foure
            if(count($year1) != 0 || count($year2) != 0 || count($year3) != 0){
                if(count($year4) != 0){
                    $year4 = range(37,max($year4));
                }else{
                    $year4 = [];
                }
            }else{
                if(count($year4) != 0){
                    $year4 = range(min($year4),max($year4));
                }else{
                    $year4 = [];
                }
            }
            $allyears = array(count($year1), count($year2), count($year3), count($year4));
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
        // $randname = str_random(10);
        $randname = $fulltbp->minitbp->businessplan->code.$company->fullname.'_'.Carbon::now()->timestamp;
        $shortpdf->save($path.$randname.'st.pdf');
        $pdf->save($path.$randname.'.pdf');
        FullTbp::find($request->id)->update([
            'shortpdf' => 'storage/uploads/' . $randname.'st.pdf'
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

        $fulltbphistory = new FullTbpHistory();
        $fulltbphistory->full_tbp_id = $request->id;
        $fulltbphistory->path = $filelocation;
        $fulltbphistory->message = $request->message;
        $fulltbphistory->save();

        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $message = 'แผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project ;
        $fulltbp_edit_note = "";
        if($fulltbp->refixstatus == 1){
            $fulltbp->update([
                'refixstatus' => 2  
            ]);
            $message = 'แผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project. 'ที่มีการแก้ไข' ;
            $fulltbp_edit_note = ' โดยมีรายละเอียด ดังนี้<br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$request->message.'</div><br>';
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

        $arr1 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr2 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2));

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $businessplan->id;
        $timeLinehistory->mini_tbp_id = $minitbp->id;
        $timeLinehistory->details = 'ผู้ประกอบการ: ส่งแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project;
        $timeLinehistory->message_type = 2;
        $timeLinehistory->viewer = $userarray;
        $timeLinehistory->owner_id = $auth->id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        $messagebox = Message::sendMessage($message . $fullcompanyname,$fullcompanyname . ' ได้ส่ง'.$message . $fulltbp_edit_note .' โปรดตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,User::find($projectassignment->leader_id)->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). $fullcompanyname .' ได้ส่ง'.$message.$fulltbp_edit_note.' โปรดตรวจสอบ <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a> ';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($projectassignment->leader_id)->email,'','TTRS: '.$message . $fullcompanyname,'เรียน Leader<br><br> '. $fullcompanyname. ' ได้ส่ง'.$message. $fulltbp_edit_note.' โปรดตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success">คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
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
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);

        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;

        $fullcompanyname = ' ' . $company_name;
        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }


        $fulltbphistory = new FullTbpHistory();
        $fulltbphistory->full_tbp_id = $request->id;
        $fulltbphistory->path = $filelocation;
        $fulltbphistory->message = $request->message;
        $fulltbphistory->save();

        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $message = 'แผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project ;
        $fulltbp_edit_note = '';
        if($fulltbp->refixstatus == 1){
            $fulltbp->update([
                'refixstatus' => 2  
            ]);
            $message = 'แผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project. ' ที่มีการแก้ไข' ;
            $fulltbp_edit_note = ' โดยมีรายละเอียด ดังนี้<br><br><div style="border-style: dashed;border-width: 2px; padding:10px">'.$request->message.'</div><br>';
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

        $arr1 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr2 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2));

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $businessplan->id;
        $timeLinehistory->mini_tbp_id = $minitbp->id;
        $timeLinehistory->details = 'ผู้ประกอบการ: ส่งแผนธุรกิจเทคโนโลยี (Full TBP) โครงการ' . $minitbp->project;
        $timeLinehistory->message_type = 2;
        $timeLinehistory->viewer = $userarray;
        $timeLinehistory->owner_id = $auth->id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        $messagebox = Message::sendMessage($message . $fullcompanyname,$fullcompanyname . ' ได้ส่ง'.$message.$fulltbp_edit_note.' โปรดตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',$auth->id,User::find($projectassignment->leader_id)->id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). $fullcompanyname . ' ได้ส่ง'.$message.$fulltbp_edit_note.' โปรดตรวจสอบ <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>  ';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($projectassignment->leader_id)->email,'','TTRS: '.$message . $fullcompanyname,'เรียน Leader<br><br> '. $fullcompanyname . ' ได้ส่ง'.$message.$fulltbp_edit_note.' โปรดตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.view',['id' => $fulltbp->id]).'" class="btn btn-sm bg-success">คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature()); 
        
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

       $company_name = (!Empty($company->name))?$company->name:'';
       $bussinesstype = $company->business_type_id;

       $fullcompanyname = ' ' . $company_name;
       if($bussinesstype == 1){
           $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
       }else if($bussinesstype == 2){
           $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
       }else if($bussinesstype == 3){
           $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
       }else if($bussinesstype == 4){
           $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
       }


       $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
       $projectmembers = ProjectMember::where('full_tbp_id',$request->id)->get();
       $membermails = array();
        foreach($projectmembers as $projectmember){
            $user = User::find($projectmember->user_id);
            
            $messagebox =  Message::sendMessage('ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว โครงการ' . $minitbp->project .$fullcompanyname ,'Leader ยืนยันการประเมิน ณ สถานประกอบการ โครงการ' . $minitbp->project . $fullcompanyname . ' เสร็จเรียบร้อยแล้ว กรุณาเตรียมพร้อมในการลงคะแนน ในลำดับถัดไป',Auth::user()->id,$user->id);
          
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =  $user->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' Leader ยืนยันการประเมิน ณ สถานประกอบการ โครงการ' . $minitbp->project . $fullcompanyname .' เสร็จเรียบร้อยแล้ว' ;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            $membermails[] = $user->email;
        }

        EmailBox::send($membermails,'','TTRS: ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว สำหรับโครงการ' . $minitbp->project  .$fullcompanyname,'เรียน ผู้เชี่ยวชาญ<br><br> Leader ยืนยันการประเมิน ณ สถานประกอบการ สำหรับโครงการ' . $minitbp->project . $fullcompanyname .' เสร็จเรียบร้อยแล้ว กรุณาเตรียมพร้อมในการลงคะแนน ในลำดับถัดไป <br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
       
        $messagebox =  Message::sendMessage('สร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project  .$fullcompanyname , 'กรุณาสร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project . $fullcompanyname .' โปรดตรวจสอบ <a  class="btn btn-sm bg-success" href='.route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);
        
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' สร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project . $fullcompanyname .' โปรดตรวจสอบ <a  class="btn btn-sm bg-success" href='.route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($projectassignment->leader_id)->email,'','TTRS: สร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project .  $fullcompanyname ,'เรียน Leader<br><br> ท่านได้ยืนยันการประเมิน ณ สถานประกอบการเสร็จเรียบร้อยแล้ว กรุณาสร้างปฏิทินนัดหมายการสรุปคะแนน โครงการ' . $minitbp->project . $fullcompanyname . ' โปรดตรวจสอบ <a href='.route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

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

        $arr1 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr2 = UserArray::leader($minitbp->business_plan_id);
        $arr3 = UserArray::expert($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2,$arr3));

        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
        $timeLinehistory->mini_tbp_id = $minitbp->id;
        $timeLinehistory->details = 'TTRS: ยืนยันการลงพื้นที่';
        $timeLinehistory->message_type = 2;
        $timeLinehistory->viewer = $userarray;
        $timeLinehistory->owner_id = $auth->id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        $arr1 = UserArray::expert($minitbp->business_plan_id);
        $arr2 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr3 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2,$arr3)); 

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->viewer = $userarray;
        $projectlog->action = 'ยืนยันการลงพื้นที่';
        $projectlog->save();

        CreateUserLog::createLog('ยืนยันการลงพื้นที่ โครงการ' . $minitbp->project);
    }

    public function GetApproveLog(Request $request){
        $fulltbp = FullTbp::where('id',$request->fulltbpid)->get()->each->append('createdatth');
        return response()->json($fulltbp);
    }

}
