<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\CheckListGrading;
use App\Model\PillaIndexWeigth;
use App\Model\NotificationBubble;
use App\Model\CriteriaTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssessmentEvController extends Controller
{
    public function AddEvChecklist(Request $request){
        
        foreach($request->criterias as $criteria){
            $criteriatransaction = new CriteriaTransaction();
            $criteriatransaction->ev_id = $request->evid;
            $criteriatransaction->index_type_id = $request->indextype;
            $criteriatransaction->pillar_id = $request->pillar;
            $criteriatransaction->sub_pillar_id = $request->subpillar;
            $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
            $criteriatransaction->criteria_id = $criteria;
            $criteriatransaction->save();
        }

        $checklistgrading = new CheckListGrading();
        $checklistgrading->ev_id = $request->evid;
        $checklistgrading->pillar_id = $request->pillar;
        $checklistgrading->sub_pillar_id = $request->subpillar;
        $checklistgrading->sub_pillar_index_id = $request->subpillarindex;
        $checklistgrading->gradea = $request->gradea;
        $checklistgrading->gradeb = $request->gradeb;
        $checklistgrading->gradec = $request->gradec;
        $checklistgrading->graded = $request->graded;
        $checklistgrading->gradee = $request->gradee;
        $checklistgrading->gradef = $request->gradef;
        $checklistgrading->save();

        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        if(Empty($pillaindexweigth)){
            $pillaindexweigth = new PillaIndexWeigth();
            $pillaindexweigth->ev_id = $request->evid;
            $pillaindexweigth->pillar_id = $request->pillar;
            $pillaindexweigth->sub_pillar_id = $request->subpillar;
            $pillaindexweigth->sub_pillar_index_id = $request->subpillarindex;
            $pillaindexweigth->weigth = 0;
            $pillaindexweigth->save();
        }

        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json($criteriatransactions); 
    }

    public function AddEvGrading(Request $request){
        $criteriatransaction = new CriteriaTransaction();
        $criteriatransaction->ev_id = $request->evid;
        $criteriatransaction->index_type_id = $request->indextype;
        $criteriatransaction->pillar_id = $request->pillar;
        $criteriatransaction->sub_pillar_id = $request->subpillar;
        $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
        $criteriatransaction->save();

        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        if(Empty($pillaindexweigth)){
            $pillaindexweigth = new PillaIndexWeigth();
            $pillaindexweigth->ev_id = $request->evid;
            $pillaindexweigth->pillar_id = $request->pillar;
            $pillaindexweigth->sub_pillar_id = $request->subpillar;
            $pillaindexweigth->sub_pillar_index_id = $request->subpillarindex;
            $pillaindexweigth->weigth = 0;
            $pillaindexweigth->save();
        }

        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json($criteriatransactions); 
    }
    public function GetEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json($criteriatransactions); 
    }
    public function GetEvByFulltbp(Request $request){
        $ev = Ev::where('full_tbp_id',$request->fulltbpid)->first();
        if(Empty($ev)){
            return response()->json($ev); 
        }else{
            $criteriatransactions = CriteriaTransaction::where('ev_id',$ev->id)
                                                    ->orderBy('pillar_id','asc')
                                                    ->orderBy('sub_pillar_id', 'asc')
                                                    ->orderBy('sub_pillar_index_id', 'asc')
                                                    ->get();
            return response()->json($criteriatransactions); 
        }
    }
    public function CopyEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->orgevid)
                                                    ->orderBy('pillar_id','asc')
                                                    ->orderBy('sub_pillar_id', 'asc')
                                                    ->orderBy('sub_pillar_index_id', 'asc')
                                                    ->get();
        CriteriaTransaction::where('ev_id',$request->newevid)->delete();  

        foreach($criteriatransactions as $criteriatransaction){
            $new = new CriteriaTransaction();
            $new->ev_id = $request->newevid;
            $new->index_type_id = $criteriatransaction->index_type_id;
            $new->pillar_id = $criteriatransaction->pillar_id;
            $new->sub_pillar_id = $criteriatransaction->sub_pillar_id;
            $new->sub_pillar_index_id = $criteriatransaction->sub_pillar_index_id;
            $new->criteria_id = $criteriatransaction->criteria_id;
            $new->save();

            $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->newevid)->where('sub_pillar_index_id',$new->sub_pillar_index_id)->first();
            if(Empty($pillaindexweigth)){
                $pillaindexweigth = new PillaIndexWeigth();
                $pillaindexweigth->ev_id = $new->ev_id;
                $pillaindexweigth->pillar_id = $new->pillar_id;
                $pillaindexweigth->sub_pillar_id = $new->sub_pillar_id;
                $pillaindexweigth->sub_pillar_index_id = $new->sub_pillar_index_id;
                $pillaindexweigth->weigth = 0;
                $pillaindexweigth->save();
            }
        }  
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->newevid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();     
        return response()->json($criteriatransactions);                                      
    }

    public function UpdateEvStatus(Request $request){
        $auth = Auth::user();
        $status = 1;
        if($request->chkevstatus == 1){
            $status = 2;
        }
        Ev::find($request->id)->update([
            'status' => $status
        ]);
        $ev = Ev::find($request->id);
        $admins = User::where('user_type_id',5)->pluck('id')->toArray();
        $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);

        foreach ($projectsmembers as $key => $projectsmember) {
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 6;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $projectsmember->user_id;
            $notificationbubble->save();

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =$projectsmember->user_id;
            $alertmessage->detail = 'ตรวจสอบ Ev ของโครงการ ' . $minitbp->project .' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();

            EmailBox::send(User::find($projectsmember->user_id)->email,'TTRS:ตรวจสอบ EV','เรียน Admin<br> Leader ได้สร้าง EV สำหรับโครงการ '.$minitbp->project.' โปรดตรวจสอบและกำหนด Weight ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
            Message::sendMessage('ตรวจสอบ EV','Leader ได้สร้าง EV สำหรับโครงการ '.$minitbp->project.' โปรดตรวจสอบและกำหนด Weight ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$projectsmember->user_id);
        }

        $ev = Ev::find($request->id);
        return response()->json($ev);
    }

    public function UpdateAdminEvStatus(Request $request){
        $auth = Auth::user();

        Ev::find($request->id)->update([
            'status' => $request->value
        ]);

        $ev = Ev::find($request->id);
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 6;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
        $notificationbubble->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
        $alertmessage->detail = 'ตรวจสอบ Ev ของโครงการ ' . $minitbp->project . ' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:ตรวจสอบ EV','เรียน JD<br> Admin ได้สร้าง EV สำหรับโครงการ '.$minitbp->project.' โปรดตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        Message::sendMessage('ตรวจสอบ EV','Admin ได้สร้าง EV สำหรับโครงการ '.$minitbp->project.' โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',6)->first()->id);

        return response()->json($ev);  
    }

    function EditApprove(Request $request){
        $auth = Auth::user();
        $ev = Ev::find($request->id);
        if($request->val == 1){
            Ev::find($request->id)->update([
                'status' => 4,
                'refixstatus' => 0
            ]);
            $ev = Ev::find($request->id);
            $admins = User::where('user_type_id',5)->pluck('id')->toArray();
            $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
            $fulltbp = FullTbp::find($ev->full_tbp_id);
            $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);

            foreach ($projectsmembers as $key => $projectsmember) {
                $notificationbubble = new NotificationBubble();
                $notificationbubble->business_plan_id = $businessplan->id;
                $notificationbubble->notification_category_id = 1;
                $notificationbubble->notification_sub_category_id = 6;
                $notificationbubble->user_id = $auth->id;
                $notificationbubble->target_user_id = $projectsmember->user_id;
                $notificationbubble->save();

                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id =$projectsmember->user_id;
                $alertmessage->detail = 'EV ผ่านการอนุมัติ' . $minitbp->project .' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
                $alertmessage->save();

                EmailBox::send(User::find($projectsmember->user_id)->email,'TTRS:EV ผ่านการอนุมัติ','เรียน Admin<br> JD ได้อนุมัติ EV สำหรับโครงการ '.$minitbp->project.' ตรวจสอบได้ที่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
                Message::sendMessage('EV ผ่านการอนุมัติ','JD ได้อนุมัติ EV สำหรับโครงการ  '.$minitbp->project.' ตรวจสอบได้ที่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$projectsmember->user_id);
            }
        }else{
            Ev::find($request->id)->update(
                [
                    'refixstatus' => 1
                ]
            );

            $ev = Ev::find($request->id);
            $admins = User::where('user_type_id',5)->pluck('id')->toArray();
            $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
            $fulltbp = FullTbp::find($ev->full_tbp_id);
            $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);

            foreach ($projectsmembers as $key => $projectsmember) {
                $notificationbubble = new NotificationBubble();
                $notificationbubble->business_plan_id = $businessplan->id;
                $notificationbubble->notification_category_id = 1;
                $notificationbubble->notification_sub_category_id = 6;
                $notificationbubble->user_id = $auth->id;
                $notificationbubble->target_user_id = $projectsmember->user_id;
                $notificationbubble->save();

                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id =$projectsmember->user_id;
                $alertmessage->detail = 'ให้แก้ไข EV ของโครงการ' . $minitbp->project . ' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
                $alertmessage->save();

                EmailBox::send(User::find($projectsmember->user_id)->email,'TTRS:แก้ไข EV','เรียน Admin<br> JD ได้ตรวจ EV สำหรับโครงการ '.$minitbp->project.' มีข้อแก้ไขดังนี้ '.$request->note.' ให้แก้ไขใหม่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
                Message::sendMessage('แก้ไข EV','JD ได้ตรวจ EV สำหรับโครงการ  '.$minitbp->project.' มีข้อแก้ไขดังนี้ '.$request->note.' ให้แก้ไขใหม่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,$projectsmember->user_id);
            }

        }
        return response()->json($ev);  
    }

    public function SendEditEv(Request $request){
        $auth = Auth::user();
        Ev::find($request->id)->update(
            [
                'refixstatus' => 2
            ]
        );
        $ev = Ev::find($request->id);
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 6;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
        $notificationbubble->save();

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
        $alertmessage->detail = 'มีการแก้ไข Ev ของโครงการ ' . $minitbp->project . ' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
        $alertmessage->save();

        EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:ตรวจสอบ EV','เรียน JD<br> Admin ได้แก้ไข EV สำหรับโครงการ '.$minitbp->project.' โปรดตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS');
        Message::sendMessage('ตรวจสอบ EV','Admin ได้แก้ไข EV สำหรับโครงการ '.$minitbp->project.' โปรดตรวจสอบได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a> <br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',6)->first()->id);

        return response()->json($ev);  

    }
}
