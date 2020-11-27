<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ExpertComment;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use Illuminate\Support\Facades\Auth;

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
                                                        ->withUsers($users);
    }
    public function EditSave(Request $request,$id){
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
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $projectassignment->leader_id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ผู้เชี่ยวชาญ คุณ'.$auth->name .' '. $auth->lastname .' ได้แสดงความเห็นสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a>';
        $alertmessage->save();
        
        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ผู้เชี่ยวชาญได้แสดงความเห็นสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว','เรียน Leader<br> ผู้เชี่ยวชาญ คุณ'.$auth->name .' '. $auth->lastname .' ได้แสดงความเห็นสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS');
        Message::sendMessage('ผู้เชี่ยวชาญได้แสดงความเห็นสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว','ผู้เชี่ยวชาญ คุณ'.$auth->name .' '. $auth->lastname .' ได้แสดงความเห็นสำหรับโครงการ' . $minitbp->project . ' เสร็จแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.assignexpert',['id' => $fulltbp->id]).'>ตรวจสอบ</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$projectassignment->leader_id);
        return redirect()->route('dashboard.expert.report')->withSuccess('เพิ่มรายการสำเร็จ');
    }
}