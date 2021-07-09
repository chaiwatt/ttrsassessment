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
use App\Model\ExpertDoc;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\ExpertField;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ExpertDetail;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Model\ExpertEducation;
use App\Model\ExpertAssignment;
use App\Model\ExpertExperience;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;

class ExpertController extends Controller
{
    //
    public function DeleteExperience(Request $request){
        ExpertExperience::find($request->id)->delete();
        $expertexperiences = ExpertExperience::get();
        return response()->json($expertexperiences);  
    }

    public function DeleteEducation(Request $request){
        ExpertEducation::find($request->id)->delete();
        $experteducations = ExpertEducation::get();
        return response()->json($experteducations);  
    }
    public function AddExpertField(Request $request){
        $auth = Auth::user();
        $expertfield = new ExpertField();
        $expertfield->user_id = $auth->id;
        $expertfield->order = $request->expertfieldnum;
        $expertfield->detail = $request->expertfielddetail;
        $expertfield->save();
        $expertfields = ExpertField::where('user_id',$auth->id)->orderBy('order','asc')->get();
        return response()->json($expertfields);  
    }
    public function GetExpertField(Request $request){
        $expertfield = ExpertField::find($request->id);
        return response()->json($expertfield);  
    }
    public function DeleteExpertField(Request $request){
        $expertdetail = ExpertField::find($request->id)->delete();
        $expertfields = ExpertField::where('user_id',Auth::user()->id)->orderBy('order','asc')->get();
        return response()->json($expertfields);  
    }
    public function EditExpertField(Request $request){
        $auth = Auth::user();
        ExpertField::find($request->id)->update([
            'order' => $request->expertfieldnum,
            'detail' => $request->expertfielddetail
        ]);
        $expertfields = ExpertField::where('user_id',$auth->id)->orderBy('order','asc')->get();
        return response()->json($expertfields); 
    }
    public function AddExpertDoc(Request $request){
        $auth = Auth::user();
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/expert/expertdoc/attachment" , $new_name);
        $filelocation = "storage/uploads/expert/expertdoc/attachment/".$new_name;

        $expertdoc = new ExpertDoc();
        $expertdoc->user_id = $auth->id;
        $expertdoc->name = $file->getClientOriginalName();
        $expertdoc->path = $filelocation;
        $expertdoc->save();
        $expertdocs = ExpertDoc::where('user_id',$auth->id)->get();
        return response()->json($expertdocs);  
    }

    public function DeleteExpertDoc(Request $request){
        $expertdoc = ExpertDoc::find($request->id);
        @unlink($expertdoc->path);
        $expertdoc->delete();
        $expertdocs = ExpertDoc::where('user_id',Auth::user()->id)->get();
        return response()->json($expertdocs); 
    }
    
    public function AssignExpert(Request $request){
        if($request->status == 1){
            ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->delete();
        }elseif($request->status == 2){
            $check = ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->first();
            if(Empty($check)){
                $expertassignment = new ExpertAssignment();
                $expertassignment->full_tbp_id = $request->fulltbpid;
                $expertassignment->user_id = $request->id;
                $expertassignment->expert_assignment_status_id = 1;
                $expertassignment->save();
            }
        }  
    }

    public function JdAssignExpert(Request $request){
            $auth =Auth::user();
            ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->first()->update([
                'expert_assignment_status_id' => 2
            ]);
            
            $expert = User::find($request->id);
            $minitbp = MiniTBP::find(FullTbp::find($request->fulltbpid)->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            $company = Company::find($businessplan->company_id);


            $company_name = (!Empty($company->name))?$company->name:'';
            $bussinesstype = $businessplan->business_type_id;

            $fullcompanyname = $company_name;
            if($bussinesstype == 1){
                $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
            }else if($bussinesstype == 2){
                $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
            }else if($bussinesstype == 3){
                $fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
            }else if($bussinesstype == 4){
                $fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
            }

            $messagebox = Message::sendMessage('การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project .' ของ' . $fullcompanyname,'ท่านได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' ของ'.$fullcompanyname.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>ดำเนินการ</a>',Auth::user()->id,$request->id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id = $request->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ '.$minitbp->project .' ของ'.$fullcompanyname;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            CreateUserLog::createLog('มอบหมาย '.$expert->name . ' ' .$expert->lastname.' เป็นผู้เชี่ยวชาญในโครงการ' . $minitbp->project .' ของ'.$fullcompanyname);

            $projectlog = new ProjectLog();
            $projectlog->mini_tbp_id = $minitbp->id;
            $projectlog->user_id = $auth->id;
            $projectlog->action = 'Manager มอบหมายผูเชี่ยวชาญ (รายละเอียด: คุณ' . $expert->name . ' ' .$expert->lastname . ')';
            $projectlog->save();

            EmailBox::send($expert->email,'TTRS:การมอบหมายผู้เชี่ยวชาญ โครงการ'.$minitbp->project .' ของ'.$fullcompanyname,'เรียนคุณ'.$expert->name . ' ' .$expert->lastname.'<br><br> ท่านได้รับมอบหมายให้เป็นผู้เชี่ยวชาญในโครงการ'.$minitbp->project.' ของ'.$fullcompanyname.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.expert.report').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
    }

    public function ExpertReject(Request $request){
        $auth = Auth::user();
        ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->first()->update([
            'accepted' => 2,
            'rejectreason' => $request->note
        ]);

        $fulltbp = FullTbp::find($request->fulltbpid);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $company = Company::find($businessplan->company_id);

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();
        
        $messagebox =  Message::sendMessage('ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ,'ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$projectassignment->leader_id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);
        
        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name,'เรียน Leader<br><br> ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        $jduser = User::where('user_type_id',6)->first();
        $messagebox =  Message::sendMessage('ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ,'ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a>',Auth::user()->id,$jduser->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $jduser->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project ;
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);
        
        EmailBox::send($jduser->email,'TTRS:ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name,'เรียน Manager<br><br> ผู้เชี่ยวชาญ คุณ'.$auth->name . ' '. $auth->lastname .' ปฎิเสธเข้าร่วมโครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        CreateUserLog::createLog('ปฎิเสธเป็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project);

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'ผู้เชี่ยวชาญปฎิเสธ (รายละเอียด: '.$request->note.')';
        $projectlog->save();

        return redirect()->route('dashboard.expert.report')->withSuccess('คุณปฎิเสธเข้าร่วมโครงการแล้ว');

    }
    public function ShowReject(Request $request){
        return ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('user_id',$request->id)->first()->rejectreason;
    }
    public function JdConfirm(Request $request){
       $auth = Auth::user();
       $check = ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('accepted',1)->get();
       if($check->count() != 0){
            ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->where('accepted','!=',1)->delete();
            $expertassignments = ExpertAssignment::where('full_tbp_id',$request->fulltbpid)->get();
            foreach ($expertassignments as $key => $expertassignment) {
                $check = ProjectMember::where('full_tbp_id',$request->fulltbpid)->where('user_id',$expertassignment->user_id)->first();
                if(Empty($check)){
                    $isexpert = ExpertDetail::where('user_id',$expertassignment->user_id)->first();
                    if(Empty($isexpert)){
                        $projectmember = new ProjectMember();
                        $projectmember->full_tbp_id = $request->fulltbpid;
                        $projectmember->user_id = $expertassignment->user_id;
                        $projectmember->save();
                    }else{
                        if($isexpert->expert_type_id == 1){
                            $projectmember = new ProjectMember();
                            $projectmember->full_tbp_id = $request->fulltbpid;
                            $projectmember->user_id = $expertassignment->user_id;
                            $projectmember->save();
                        }
                    }

                }
            }
            FullTbp::find($request->fulltbpid)->update([
                'assignexpert' => 2
            ]);

            $fulltbp = FullTbp::find($request->fulltbpid);
            $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            $company = Company::find($businessplan->company_id);
            $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
            
            $messagebox =  Message::sendMessage('Manager ได้ยืนยันทีมผู้เชี่ยวชาญ โครงการ' . $minitbp->project,'Manager ได้ยืนยันทีมผู้เชี่ยวชาญ โครงการ' . $minitbp->project . ' บริษัท' . $company->name .' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' =>  $request->fulltbpid]).'>คลิกที่นี่</a>',Auth::user()->id,$projectassignment->leader_id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =  $projectassignment->leader_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' Manager ได้ยืนยันทีมผู้เชี่ยวชาญ โครงการ' . $minitbp->project;
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
            
            EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:Manager ได้ยืนยันทีมผู้เชี่ยวชาญ โครงการ' . $minitbp->project . ' บริษัท' . $company->name,'เรียน Leader<br><br> Manager ได้ยืนยันทีมผู้เชี่ยวชาญ โครงการ' . $minitbp->project . ' บริษัท' . $company->name . ' โปรดตรวจสอบ <a href='.route('dashboard.admin.project.fulltbp.assignexpertreview',['id' =>  $request->fulltbpid]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            
            $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',3)->first();
            if($projectstatustransaction->status == 1){
                $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
                if($businessplan->business_plan_status_id == 6 && $fulltbp->assignexpert == 2 && $ev->status == 4){
                    $projectstatustransaction->update([
                        'status' => 2
                    ]);
                    
                   $projectstatustransaction = new ProjectStatusTransaction();
                   $projectstatustransaction->mini_tbp_id = $minitbp->id;
                   $projectstatustransaction->project_flow_id = 4;
                   $projectstatustransaction->save();

                   $messagebox =  Message::sendMessage('สร้างปฏิทินนัดหมาย โครงการ' . $minitbp->project . ' บริษัท' . $company->name ,'EV และ Weighting โครงการ' . $minitbp->project . 'ได้รับการอนุมัติแล้ว กรุณาสร้างปฏิทินกิจกรรมเพื่อนัดหมายการประเมินต่อไป โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);
                   $alertmessage = new AlertMessage();
                   $alertmessage->user_id = $auth->id;
                   $alertmessage->target_user_id =  $projectassignment->leader_id;
                   $alertmessage->messagebox_id = $messagebox->id;
                   $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString() .' EV และ Weighting โครงการ' . $minitbp->project . 'ได้รับการอนุมัติแล้ว กรุณาสร้างปฏิทินกิจกรรมเพื่อนัดหมายการประเมินต่อไป โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id]).'>ดำเนินการ</a>' ;
                   $alertmessage->save();

                   MessageBox::find($messagebox->id)->update([
                        'alertmessage_id' => $alertmessage->id
                    ]);

                   EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:สร้างปฏิทินนัดหมาย โครงการ' . $minitbp->project . ' บริษัท' . $company->name,'เรียน Leader<br><br> EV และ Weighting โครงการ' . $minitbp->project .  ' บริษัท' . $company->name . ' ได้รับการอนุมัติแล้ว กรุณาสร้างปฏิทินกิจกรรมเพื่อนัดหมายการประเมินต่อไป โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.calendar.createcalendar',['id' => $fulltbp->id]).'>ดำเนินการ</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                   DateConversion::addExtraDay($minitbp->id,3);

                   ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',3)->first()->update([
                        'actual_startdate' =>  Carbon::now()->toDateString()
                    ]);
                }
            }
            CreateUserLog::createLog('ยืนยันทีมผู้เชี่ยวชาญ โครงการ' . $minitbp->project);

            $projectlog = new ProjectLog();
            $projectlog->mini_tbp_id = $minitbp->id;
            $projectlog->user_id = $auth->id;
            $projectlog->action = 'ยืนยันทีมผู้เชี่ยวชาญ';
            $projectlog->save();

            return response()->json($expertassignments);
       }
 
    }
    
}
