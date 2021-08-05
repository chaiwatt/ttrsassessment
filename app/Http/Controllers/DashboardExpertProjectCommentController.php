<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ExpertComment;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpertCommentRequest;

class DashboardExpertProjectCommentController extends Controller
{
    public function Edit($id){
        $expertcomment = ExpertComment::where('full_tbp_id',$id)->where('user_id',Auth::user()->id)->first();
        $fulltbp = FullTbp::find($id);
        $businessplan = BusinessPlan::find(MiniTBP::find($fulltbp->mini_tbp_id)->business_plan_id);

        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $user_array[] = $projectassignment->leader_id;
        $user_array[] = $projectassignment->coleader_id;
        foreach(User::where('user_type_id','>=',6)->get() as $user ){
            $user_array[] = $user->id;
        }
        $users = User::whereIn('id',$user_array)->get();
        return view('dashboard.expert.project.comment.edit')->withExpertcomment($expertcomment)
                                                        ->withFulltbp($fulltbp)
                                                        ->withUsers($users)
                                                        ->withBusinessplan($businessplan);
    }
    public function EditSave(ExpertCommentRequest $request,$id){
        $auth = Auth::user(); 
        $expertcomment = ExpertComment::where('full_tbp_id',$id)->where('user_id',$auth->id)->first();
        if(Empty($expertcomment)){
            $expertcomment = new ExpertComment();
            $expertcomment->full_tbp_id = $id;
            $expertcomment->overview = $request->overview;
            $expertcomment->management = $request->management;
            $expertcomment->technology = $request->technology;
            $expertcomment->marketing = $request->marketing;
            $expertcomment->businessprospect = $request->businessprospect;
            $expertcomment->user_id = $auth->id;
            $expertcomment->save();
        }else{
            $expertcomment->update([
                'overview' => $request->overview,
                'management' => $request->management,
                'technology' => $request->technology,
                'marketing' => $request->marketing,
                'businessprospect' => $request->businessprospect
            ]);
        }
       
        $minitbp = MiniTBP::find($id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $notificationbubble = new NotificationBubble();

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

        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $messagebox = Message::sendMessage('ผู้เชี่ยวชาญ (คุณ'.$auth->name .' '. $auth->lastname .') ได้แสดงความเห็น โครงการ' . $minitbp->project .$fullcompanyname,'ผู้เชี่ยวชาญ คุณ'.$auth->name .' '. $auth->lastname .' ได้แสดงความเห็น โครงการ' . $minitbp->project .$fullcompanyname. ' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.assessment.expertcomment',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ผู้เชี่ยวชาญ คุณ'.$auth->name .' '. $auth->lastname .' ได้แสดงความเห็น โครงการ' . $minitbp->project . ' โปรดตรวจสอบ <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.assessment.expertcomment',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);
        
        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ผู้เชี่ยวชาญ (คุณ'.$auth->name .' '. $auth->lastname .') ได้แสดงความเห็น โครงการ' . $minitbp->project .$fullcompanyname,'เรียน Leader<br><br> ผู้เชี่ยวชาญ คุณ'.$auth->name .' '. $auth->lastname .' ได้แสดงความเห็น โครงการ' . $minitbp->project.' (' .$fullcompanyname . ') โปรดตรวจสอบ <a href='.route('dashboard.admin.project.assessment.expertcomment',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'ผู้เชี่ยวชาญได้แสดงความเห็นโครงการ'. $minitbp->project .$fullcompanyname;
        $projectlog->save();

        CreateUserLog::createLog('เพิ่มความเห็นผู้เชี่ยวชาญ โครงการ' . $minitbp->project );
        return redirect()->route('dashboard.expert.report')->withSuccess('เพิ่มรายการสำเร็จ');
    }
}