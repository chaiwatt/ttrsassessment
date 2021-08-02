<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Model\Province;
use App\Helper\EmailBox;
use App\Model\ExpertDoc;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\ExpertField;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ExpertBranch;
use App\Model\OfficerDetail;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\EducationLevel;
use App\Helper\DateConversion;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
use App\Http\Requests\EditProjectAssignementRequest;

class DashboardAdminProjectProjectAssignmentController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',1)
                        ->where('status',0)->delete();
        $projectassignments = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->get();
        if($auth->user_type_id >= 5){
            $projectassignments = ProjectAssignment::get();
        }

        return view('dashboard.admin.project.projectassignment.index')->withProjectassignments($projectassignments);
    }
    public function Edit($id){
        $projectassignment = ProjectAssignment::find($id);
        $minitbp = MiniTBP::where('business_plan_id',BusinessPlan::find($projectassignment->business_plan_id)->id)->first();
        $users = User::where('user_type_id',4)->get();
        $projectstatus = ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',2)->first();
        $projectstatuses = ProjectStatus::where('mini_tbp_id',$minitbp->id)->get();
       
        return view('dashboard.admin.project.projectassignment.edit')->withProjectassignment($projectassignment)
                                                            ->withUsers($users)
                                                            ->withMinitbp($minitbp)
                                                            ->withProjectstatus($projectstatus)
                                                            ->withProjectstatuses($projectstatuses);
    }

    public function Personalinfo($id){
        $user = User::find($id);
        $prefixes = Prefix::get();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$user->province_id)->get();
        $tambols = Tambol::where('amphur_id',$user->amphur_id)->get();
        $amphurs1 = Amphur::where('province_id',$user->province1_id)->get();
        $tambols1 = Tambol::where('amphur_id',$user->amphur1_id)->get();
        $officerbanches = ExpertBranch::get();
        $educationlevels = EducationLevel::get();
        $officer = OfficerDetail::where('user_id',$user->id)->first();
        $officerfields = ExpertField::where('user_id',$user->id)->orderBy('order','asc')->get();
        $officerdocs = ExpertDoc::where('user_id',$user->id)->get();
        
        return view('dashboard.admin.project.projectassignment.personalinfo')->withUser($user)
                                            ->withPrefixes($prefixes)
                                            ->withProvinces($provinces)
                                            ->withAmphurs($amphurs)
                                            ->withTambols($tambols)
                                            ->withAmphurs1($amphurs1)
                                            ->withTambols1($tambols1)
                                            ->withOfficerbanches($officerbanches)
                                            ->withEducationlevels($educationlevels)
                                            ->withOfficer($officer)
                                            ->withOfficerfields($officerfields)
                                            ->withOfficerdocs($officerdocs);
        return $id;
    }
    public function EditSave(EditProjectAssignementRequest $request,$id){
        $auth = Auth::user();
        ProjectAssignment::find($id)->update([
            'leader_id' => $request->leader,
            'coleader_id' => $request->coleader,
        ]);
        $businessplan = BusinessPlan::find(ProjectAssignment::find($id)->business_plan_id);
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();

        $company_name = (!Empty($businessplan->company->name))?$businessplan->company->name:'';
        $bussinesstype = $businessplan->company->business_type_id;

        $fullcompanyname = $company_name;
        if($bussinesstype == 1){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        $projectmember = ProjectMember::where('full_tbp_id',$fulltbp->id)
                ->where('user_id',$request->leader)->first();
        if(Empty($projectmember)){
            $projectmember = new ProjectMember();
            $projectmember->full_tbp_id = $fulltbp->id;
            $projectmember->user_id = $request->leader;
            $projectmember->save();
        }

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 4;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $request->leader;
        $notificationbubble->save();

        $messagebox = Message::sendMessage('มอบหมาย Leader โครงการ' . $minitbp->project ,'ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitbp->project. $fullcompanyname.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>ดำเนินการ</a>',Auth::user()->id,User::find($request->leader)->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->target_user_id = User::find($request->leader)->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitbp->project . $fullcompanyname.' โปรดตรวจสอบแบบคำขอรับบริการประเมิน TTRS (Mini TBP) ในขั้นตอนต่อไป <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        if(!Empty($request->coleader)){
            $messagebox = Message::sendMessage('มอบหมาย Co-Leader โครงการ'. $minitbp->project,'ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitbp->project.$fullcompanyname,Auth::user()->id,User::find($request->coleader)->id) ;
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id = User::find($request->coleader)->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitbp->project . $fullcompanyname;
            $alertmessage->save();
    
            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
    
            EmailBox::send(User::find($request->coleader)->email,'TTRS:มอบหมาย Co-Leader โครงการ'.$minitbp->project .$fullcompanyname,'เรียนคุณ'.User::find($request->coleader)->name. ' ' .User::find($request->coleader)->lastname.'<br><br> ท่านได้รับมอบหมายให้เป็น Co-Leader ในโครงการ'.$minitbp->project.$fullcompanyname.'</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());    
        }

        EmailBox::send(User::find($request->leader)->email,'TTRS:มอบหมาย Leader โครงการ'.$minitbp->project .$fullcompanyname,'เรียนคุณ'.User::find($request->leader)->name. ' ' .User::find($request->leader)->lastname. '<br><br> ท่านได้รับมอบหมายให้เป็น Leader ในโครงการ'.$minitbp->project.$fullcompanyname.' โปรดตรวจสอบข้อมูล <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.minitbp.view',['id' => $minitbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        

        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',1)->first();
        if($projectstatustransaction->status == 1){
            $projectstatustransaction->update([
                'status' => 2
            ]);
            $projectstatustransaction = new ProjectStatusTransaction();
            $projectstatustransaction->mini_tbp_id = $minitbp->id;
            $projectstatustransaction->project_flow_id = 2;
            $projectstatustransaction->save();

            DateConversion::addExtraDay($minitbp->id,1);

        }

        $projectstatus = ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',1)->first()->update([
            'actual_startdate' =>  Carbon::now()->toDateString()
        ]);

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'มอบหมาย Leader และ Co-Leader';
        $projectlog->save();

        CreateUserLog::createLog('มอบหมาย Leader และ Co-Leader โครงการ' . $minitbp->project);
        return redirect()->route('dashboard.admin.project.projectassignment')->withSuccess('การมอบหมายสำเร็จ');
    }
    public function GetWorkLoadLeader(Request $request){
        $businessplanids = ProjectAssignment::where('leader_id',$request->userid)->pluck('business_plan_id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
        $allprojects = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();

        $finishbusinessplans = BusinessPlan::whereIn('id',$businessplanids)->where('finished',1)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id',$finishbusinessplans)->pluck('id')->toArray();
        $finishedprojects = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json(array(
            "allprojects" => $allprojects,
            "finishedprojects" => $finishedprojects
        ));
    }
    public function GetWorkLoadCoLeader(Request $request){
        $businessplanids = ProjectAssignment::where('coleader_id',$request->userid)->pluck('business_plan_id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
        $allprojects = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();

        $finishbusinessplans = BusinessPlan::whereIn('id',$businessplanids)->where('finished',1)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereIn('business_plan_id',$finishbusinessplans)->pluck('id')->toArray();
        $finishedprojects = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json(array(
            "allprojects" => $allprojects,
            "finishedprojects" => $finishedprojects
        ));
    }
}
