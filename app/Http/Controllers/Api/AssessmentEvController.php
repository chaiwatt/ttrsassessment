<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\Pillar;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Model\SubPillar;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\EvCommentTab;
use App\Model\EvEditHistory;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\SubPillarIndex;
use App\Helper\DateConversion;
use App\Model\CheckListGrading;
use App\Model\PillaIndexWeigth;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Model\CriteriaTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\ExtraCriteriaTransaction;
use App\Model\ProjectStatusTransaction;

class AssessmentEvController extends Controller
{
    public function AddEvChecklist(Request $request){
        $subpillarindex = SubPillarIndex::find($request->subpillarindex);
        $subpillar = SubPillar::find($subpillarindex->sub_pillar_id);
        $pillar = Pillar::find($subpillar->pillar_id);

        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$request->evid)
                                            ->orderBy('pillar_id','asc')
                                            ->orderBy('sub_pillar_id', 'asc')
                                            ->orderBy('sub_pillar_index_id', 'asc')
                                            ->get()->makeHidden('pillar')->makeHidden('subpillar')->makeHidden('subpillarindex');
        $check_grade = CriteriaTransaction::where('ev_id',$request->evid)
                                    ->where('index_type_id',1)
                                    ->where('pillar_id',$pillar->id)
                                    ->where('sub_pillar_id',$subpillar->id)
                                    ->where('sub_pillar_index_id',$request->subpillarindex)
                                    ->first();
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                        ->orderBy('pillar_id','asc')
                        ->orderBy('sub_pillar_id', 'asc')
                        ->orderBy('sub_pillar_index_id', 'asc')
                        ->get();
        if(!Empty($check_grade)){
            return response()->json(array(
                                "criteriatransactions" => $criteriatransactions,
                                "pillaindexweigths" => $pillaindexweigths,
                                "result" => '0'
                            ));                
        }
        CriteriaTransaction::where('ev_id',$request->evid)
                            ->where('index_type_id',$request->indextype)
                            ->where('pillar_id',$pillar->id)
                            ->where('sub_pillar_id',$subpillar->id)
                            ->where('sub_pillar_index_id',$request->subpillarindex)
                            ->whereNotIn('criteria_id',$request->criterias)->delete();

        foreach($request->criterias as $criteria){
            $check = CriteriaTransaction::where('ev_id',$request->evid)
                                    ->where('index_type_id',$request->indextype)
                                    ->where('pillar_id',$pillar->id)
                                    ->where('sub_pillar_id',$subpillar->id)
                                    ->where('sub_pillar_index_id',$request->subpillarindex)
                                    ->where('criteria_id',$criteria)->first();
            if(Empty($check)){
                $criteriatransaction = new CriteriaTransaction();
                $criteriatransaction->ev_id = $request->evid;
                $criteriatransaction->index_type_id = $request->indextype;
                $criteriatransaction->pillar_id = $pillar->id;
                $criteriatransaction->sub_pillar_id = $subpillar->id;
                $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
                $criteriatransaction->criteria_id = $criteria;
                $criteriatransaction->save();
            }else{
                return response()->json(array(
                    "criteriatransactions" => $criteriatransactions,
                    "pillaindexweigths" => $pillaindexweigths,
                    "result" => '0'
                ));  
            }
        }

        $check = CheckListGrading::where('ev_id',$request->evid)->where('pillar_id',$pillar->id)
                                ->where('sub_pillar_id',$subpillar->id)
                                ->where('sub_pillar_index_id',$request->subpillarindex)->first();
        
        if(Empty($check)){
            $checklistgrading = new CheckListGrading();
            $checklistgrading->ev_id = $request->evid;
            $checklistgrading->pillar_id = $pillar->id;
            $checklistgrading->sub_pillar_id = $subpillar->id;
            $checklistgrading->sub_pillar_index_id = $request->subpillarindex;
            $checklistgrading->gradea = $request->gradea;
            $checklistgrading->gradeb = $request->gradeb;
            $checklistgrading->gradec = $request->gradec;
            $checklistgrading->graded = $request->graded;
            $checklistgrading->gradee = $request->gradee;
            $checklistgrading->save();
        }else{
            CheckListGrading::where('ev_id',$request->evid)->where('pillar_id',$pillar->id)
                ->where('sub_pillar_id',$subpillar->id)
                ->where('sub_pillar_index_id',$request->subpillarindex)->first()->update([
                    'gradea' => $request->gradea,
                    'gradeb' => $request->gradeb,
                    'gradec' => $request->gradec,
                    'graded' => $request->graded,
                    'gradee' => $request->gradee,
                ]);
        }

        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        if(Empty($pillaindexweigth)){
            $pillaindexweigth = new PillaIndexWeigth();
            $pillaindexweigth->ev_id = $request->evid;
            $pillaindexweigth->pillar_id = $pillar->id;
            $pillaindexweigth->sub_pillar_id = $subpillar->id;
            $pillaindexweigth->sub_pillar_index_id = $request->subpillarindex;
            $pillaindexweigth->weigth = 0;
            $pillaindexweigth->save();
        }

        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "pillaindexweigths" => $pillaindexweigths,
            "result" => '1'
        ));                                           
    }

    public function AddEvGrading(Request $request){
        $subpillarindex = SubPillarIndex::find($request->subpillarindex);
        $subpillar = SubPillar::find($subpillarindex->sub_pillar_id);
        $pillar = Pillar::find($subpillar->pillar_id);

        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$request->evid)
                                        ->orderBy('pillar_id','asc')
                                        ->orderBy('sub_pillar_id', 'asc')
                                        ->orderBy('sub_pillar_index_id', 'asc')
                                        ->get()->makeHidden('pillar')->makeHidden('subpillar')->makeHidden('subpillarindex');
        
        $check_list = CriteriaTransaction::where('ev_id',$request->evid)
            ->where('index_type_id',2)
            ->where('pillar_id',$pillar->id)
            ->where('sub_pillar_id',$subpillar->id)
            ->where('sub_pillar_index_id',$request->subpillarindex)
            ->get();
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        if($check_list->count() > 0){
            return response()->json(array(
                "criteriatransactions" => $criteriatransactions,
                "pillaindexweigths" => $pillaindexweigths,
                "result" => '0'
            ));  
        }

        $check = CriteriaTransaction::where('ev_id',$request->evid)
                                    ->where('index_type_id',$request->indextype)
                                    ->where('pillar_id',$pillar->id)
                                    ->where('sub_pillar_id',$subpillar->id)
                                    ->where('sub_pillar_index_id',$request->subpillarindex)
                                    ->first();


        if(Empty($check)){
            $check_list = CriteriaTransaction::where('ev_id',$request->evid)
                                    ->where('index_type_id',2)
                                    ->where('pillar_id',$pillar->id)
                                    ->where('sub_pillar_id',$subpillar->id)
                                    ->where('sub_pillar_index_id',$request->subpillarindex)
                                    ->get();
            if($check_list->count() == 0){
                $criteriatransaction = new CriteriaTransaction();
                $criteriatransaction->ev_id = $request->evid;
                $criteriatransaction->index_type_id = $request->indextype;
                $criteriatransaction->pillar_id = $pillar->id;
                $criteriatransaction->sub_pillar_id = $subpillar->id;
                $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
                $criteriatransaction->save();
            }
        }else{
            return response()->json(array(
                "criteriatransactions" => $criteriatransactions,
                "pillaindexweigths" => $pillaindexweigths,
                "result" => '0'
            )); 
        }

        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();

        if(Empty($pillaindexweigth)){
            $pillaindexweigth = new PillaIndexWeigth();
            $pillaindexweigth->ev_id = $request->evid;
            $pillaindexweigth->pillar_id = $pillar->id;
            $pillaindexweigth->sub_pillar_id = $subpillar->id;
            $pillaindexweigth->sub_pillar_index_id = $request->subpillarindex;
            $pillaindexweigth->weigth = 0;
            $pillaindexweigth->save();
        }

        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "pillaindexweigths" => $pillaindexweigths,
            "result" => '1'
        )); 
    }
    public function AddExtraEvGrading(Request $request){
        $criteriatransaction = new CriteriaTransaction();
        $criteriatransaction->ev_id = $request->evid;
        $criteriatransaction->ev_type_id = 2;
        $criteriatransaction->index_type_id = $request->indextype;
        $criteriatransaction->pillar_id = $request->pillar;
        $criteriatransaction->sub_pillar_id = $request->subpillar;
        $criteriatransaction->sub_pillar_index_id = $request->subpillarindex;
        $criteriatransaction->save();

        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)->where('sub_pillar_index_id',$request->subpillarindex)->first();
        if(Empty($pillaindexweigth)){
            $pillaindexweigth = new PillaIndexWeigth();
            $pillaindexweigth->ev_id = $request->evid;
            $pillaindexweigth->ev_type_id = 2;
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
            $extracriteriatransactions = ExtraCriteriaTransaction::where('ev_id',$ev->id)
                                                                ->orderBy('extra_category_id', 'asc')
                                                                ->orderBy('extra_criteria_id', 'asc')
                                                                ->get()
                                                                ->append('extracategory')
                                                                ->append('extracriteria');   
            $pillaindexweigths = PillaIndexWeigth::where('ev_id',$ev->id)
                                                                ->orderBy('pillar_id','asc')
                                                                ->orderBy('sub_pillar_id', 'asc')
                                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                                ->get()->makeHidden('pillar')->makeHidden('subpillar')->makeHidden('subpillarindex');
            
            return response()->json(array(
                "criteriatransactions" => $criteriatransactions,
                "extracriteriatransactions" => $extracriteriatransactions,
                "pillaindexweigths" => $pillaindexweigths
            ));                                       
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
            $new->ev_type_id = $criteriatransaction->ev_type_id;
            $new->pillar_id = $criteriatransaction->pillar_id;
            $new->sub_pillar_id = $criteriatransaction->sub_pillar_id;
            $new->sub_pillar_index_id = $criteriatransaction->sub_pillar_index_id;
            $new->criteria_id = $criteriatransaction->criteria_id;
            $new->save();
        }  

        PillaIndexWeigth::where('ev_id',$request->newevid)->delete(); 

        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$request->orgevid)
                                            ->orderBy('pillar_id','asc')
                                            ->orderBy('sub_pillar_id', 'asc')
                                            ->orderBy('sub_pillar_index_id', 'asc')
                                            ->get();

        foreach ($pillaindexweigths as $key => $pillaindexweigth) {
            $new = new PillaIndexWeigth();
            $new->ev_id = $request->newevid;
            $new->ev_type_id = $pillaindexweigth->ev_type_id;
            $new->pillar_id = $pillaindexweigth->pillar_id;
            $new->sub_pillar_id = $pillaindexweigth->sub_pillar_id;
            $new->sub_pillar_index_id = $pillaindexweigth->sub_pillar_index_id;
            $new->weigth = $pillaindexweigth->weigth;
            $new->save();
        }     
        
        CheckListGrading::where('ev_id',$request->newevid)->delete(); 

        $checklistgradings = CheckListGrading::where('ev_id',$request->orgevid)
                                            ->orderBy('pillar_id','asc')
                                            ->orderBy('sub_pillar_id', 'asc')
                                            ->orderBy('sub_pillar_index_id', 'asc')
                                            ->get();
        foreach ($checklistgradings as $key => $checklistgrading) {
            $new = new CheckListGrading();
            $new->ev_id = $request->newevid;
            $new->pillar_id = $checklistgrading->pillar_id;
            $new->sub_pillar_id = $checklistgrading->sub_pillar_id;
            $new->sub_pillar_index_id = $checklistgrading->sub_pillar_index_id;
            $new->gradea = $checklistgrading->gradea;
            $new->gradeb = $checklistgrading->gradeb;
            $new->gradec = $checklistgrading->gradec;
            $new->graded = $checklistgrading->graded;
            $new->gradee = $checklistgrading->gradee;
            $new->save();
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
        Ev::find($request->id)->update([
            'status' => 1
        ]);
        $ev = Ev::find($request->id);

        if($ev->refixstatus == 1){
            $ev->update([
                'refixstatus' => 2  
            ]);
        }
        $ev = Ev::find($request->id);
        // $admins = User::where('user_type_id',5)->pluck('id')->toArray();
        // $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);

        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;
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

        $message = ' ตรวจสอบ EV โครงการ' . $minitbp->project . ' ของ' . $fullcompanyname;
        if($ev->refixstatus == 2){
            $message = ' ตรวจสอบ EV ที่มีการแก้ไข โครงการ' . $minitbp->project . ' ของ' . $fullcompanyname;
        }

        $jd = User::where('user_type_id',6)->first();
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $jd->id;
        $notificationbubble->save();

        $messagebox =  Message::sendMessage($message,$message.' โปรดตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.editev',['id' => $request->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$jd->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =$jd->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). $message.' <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.fulltbp.editev',['id' => $request->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a> ';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send(User::find($jd->id)->email,'TTRS:' . $message,'เรียน Manager<br><br> ' . $message.' โปรดตรวจสอบ <a href="'.route('dashboard.admin.project.fulltbp.editev',['id' => $request->id]).'" class="btn btn-sm bg-success">คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'สร้าง/แก้ไขรายการ EV';
        $projectlog->save();

        CreateUserLog::createLog('สร้าง/แก้ไข EV โครงการ' . $minitbp->project);

        $ev = Ev::find($request->id);
        return response()->json($ev);
    }

    public function ApproveEvStageOne(Request $request){
        $auth = Auth::user();
        Ev::find($request->id)->update([
            'status' => 2,
            'refixstatus' => 0
        ]);
        $ev = Ev::find($request->id);
        // $admins = User::where('user_type_id',5)->pluck('id')->toArray();
        $admins = User::where('user_type_id',5)->get();
        // $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);

        foreach ($admins as $key => $admin) {
            $company_name = (!Empty($company->name))?$company->name:'';
            $bussinesstype = $company->business_type_id;
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

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 5;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $admin->id;
            $notificationbubble->save();

            $messagebox = Message::sendMessage(' กำหนด Weight EV โครงการ' . $minitbp->project . ' ของ' . $fullcompanyname,'Manager ได้อนุมัติ EV โครงการ' . $minitbp->project . ' ของ' . $fullcompanyname.' โปรดตรวจสอบและกำหนด Weight <a href="'.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'" class="btn btn-sm bg-success">ดำเนินการ</a>',Auth::user()->id,$admin->id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =$admin->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' กำหนด Weight EV โครงการ' . $minitbp->project . ' ของ' . $fullcompanyname .' <a data-id="'.$messagebox->id.'" href="'.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'" class="btn btn-sm bg-success linknextaction">ดำเนินการ</a> ';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            CreateUserLog::createLog('อนุมัติรายการ EV โครงการ' . $minitbp->project);

            
            $projectlog = new ProjectLog();
            $projectlog->mini_tbp_id = $minitbp->id;
            $projectlog->user_id = $auth->id;
            $projectlog->action = 'อนุมัติรายการ EV';
            $projectlog->save();

            EmailBox::send(User::find($admin->id)->email,'TTRS:กำหนด Weight EV โครงการ' . $minitbp->project . ' ของ' . $fullcompanyname,'เรียน Admin<br> Manager ได้อนุมัติ EV โครงการ' . $minitbp->project . ' ของ' . $fullcompanyname .' โปรดตรวจสอบและกำหนด Weight <a href="'.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'" class="btn btn-sm bg-success">คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            
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
        $jd = User::where('user_type_id',6)->first();

        $messagebox =  Message::sendMessage('ตรวจสอบ EV','Admin ได้สร้าง EV สำหรับโครงการ '.$minitbp->project.' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>ดำเนินการ</a>',Auth::user()->id,$jd->id);

        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jd->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ตรวจสอบค่า Weight Ev ของโครงการ ' . $minitbp->project . ' <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>ดำเนินการ</a> ';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send($jd->email,'TTRS:ตรวจสอบ EV','เรียน Manager<br><br> Admin ได้สร้าง EV สำหรับโครงการ '.$minitbp->project.' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        

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
            // $admins = User::where('user_type_id',5)->pluck('id')->toArray();
            $admins = User::where('user_type_id',5)->get();
            // $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
            $fulltbp = FullTbp::find($ev->full_tbp_id);
            $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            $company = Company::find($businessplan->company_id);

            $company_name = (!Empty($company->name))?$company->name:'';
            $bussinesstype = $company->business_type_id;
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

            foreach ($admins as $key => $admin) {
                $messagebox = Message::sendMessage('EV โครงการ' . $minitbp->project .'ของ' .$fullcompanyname. ' ผ่านการอนุมัติ','Manager ได้อนุมัติ EV สำหรับโครงการ  '.$minitbp->project.'ของ' .$fullcompanyname. ' ตรวจสอบได้ที่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a>',Auth::user()->id,$admin->id);

                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id =$admin->id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = 'EV โครงการ' . $minitbp->project .'ของ' .$fullcompanyname. ' ผ่านการอนุมัติแล้ว ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
                $alertmessage->save();

                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);

                EmailBox::send($admin->email,'TTRS:EV ของโครงการ' . $minitbp->project .'ของ' .$fullcompanyname. ' ผ่านการอนุมัติ','เรียน Admin<br><br> Manager ได้อนุมัติ EV สำหรับโครงการ '.$minitbp->project.' ของ' .$fullcompanyname. ' ตรวจสอบได้ที่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                
            }

            $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();

            $messagebox = Message::sendMessage('EV โครงการ' . $minitbp->project .' ผ่านการอนุมัติ','Manager ได้อนุมัติ EV สำหรับโครงการ  '.$minitbp->project.' ตรวจสอบได้ที่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a>',Auth::user()->id,$projectassignment->leader_id);

            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =$projectassignment->leader_id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = 'EV โครงการ' . $minitbp->project .'ของ' .$fullcompanyname. ' ผ่านการอนุมัติแล้ว ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);
            
            EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:EV โครงการ' . $minitbp->project .'ของ' .$fullcompanyname. ' ผ่านการอนุมัติ','เรียน Leader<br><br> Manager ได้อนุมัติ EV สำหรับโครงการ '.$minitbp->project.' ของ' .$fullcompanyname. ' ตรวจสอบได้ที่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
           

        }else{
            Ev::find($request->id)->update(
                [
                    'refixstatus' => 1
                ]
            );

            $ev = Ev::find($request->id);
            $admins = User::where('user_type_id',5)->get();
            // $admins = User::where('user_type_id',5)->pluck('id')->toArray();
            // $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
            $fulltbp = FullTbp::find($ev->full_tbp_id);
            $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            $company = Company::find($businessplan->company_id);

            $company_name = (!Empty($company->name))?$company->name:'';
            $bussinesstype = $company->business_type_id;
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

            foreach ($admins as $key => $admin) {
                $notificationbubble = new NotificationBubble();
                $notificationbubble->business_plan_id = $businessplan->id;
                $notificationbubble->notification_category_id = 1;
                $notificationbubble->notification_sub_category_id = 6;
                $notificationbubble->user_id = $auth->id;
                $notificationbubble->target_user_id = $admin->id;
                $notificationbubble->save();

                $messagebox = Message::sendMessage('แก้ไข EV โครงการ' . $minitbp->project . 'ของ' .$fullcompanyname,'Manager ได้ตรวจ EV สำหรับโครงการ  '.$minitbp->project. ' ของ' .$fullcompanyname . ' มีข้อแก้ไขดังนี้ '.$request->note.' ให้แก้ไขใหม่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a>',Auth::user()->id,$admin->id);

                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id =$admin->id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = 'ให้แก้ไข EV โครงการ' . $minitbp->project . 'ของ' .$fullcompanyname . ' ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
                $alertmessage->save();

                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);

                EmailBox::send($admin->email,'TTRS:แก้ไข EV โครงการ' . $minitbp->project . 'ของ' .$fullcompanyname,'เรียน Admin<br> Manager ได้ตรวจ EV สำหรับโครงการ '.$minitbp->project.' โครงการ' . $minitbp->project . ' ของ' .$fullcompanyname . ' มีข้อแก้ไขดังนี้ '.$request->note.' ให้แก้ไขใหม่ ได้ที่ <a href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
                
            }

        }
        return response()->json($ev);  
    }

    public function SendEditEv(Request $request){
        $auth = Auth::user();
        $ev = Ev::find($request->id);

        $ev->update([
            'status' => 3  
        ]);

        if($ev->refixstatus == 1){
            $ev->update([
                'refixstatus' => 2  
            ]);
        }

        $ev = Ev::find($request->id);
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);

        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;
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

        $message = ' Admin ได้กำหนด weight ของโครงการ' . $minitbp->project . ' ของ' . $fullcompanyname;
        if($ev->refixstatus == 2){
            $message = ' ตรวจสอบ EV ที่มีการแก้ไขค่า weight โครงการ' . $minitbp->project . ' ของ' . $fullcompanyname;
        }

        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
        $notificationbubble->save();

        $jd = User::where('user_type_id',6)->first();

        $messagebox = Message::sendMessage($message,'Admin ได้กำหนด weight ของโครงการ '.$minitbp->project.' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>ดำเนินการ</a>',Auth::user()->id,$jd->id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id = $jd->id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). $message. ' <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>ดำเนินการ</a> ';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        EmailBox::send($jd->email,'TTRS:'. $message,'เรียน Manager<br><br> ' .$message.' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
       
        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'กำหนดค่า EV Weight';
        $projectlog->save();

        CreateUserLog::createLog('กำหนดค่า EV Weight โครงการ' . $minitbp->project);

        return response()->json($ev);  
    }
    public function GetEvCheckList(Request $request){
        $checklistgrading = CheckListGrading::where('pillar_id',$request->pillar)
                                        ->where('sub_pillar_id',$request->subpillar)
                                        ->where('sub_pillar_index_id',$request->subpillarindex)
                                        ->first();
        return response()->json($checklistgrading); 
    }
    public function EditEv(Request $request){
        Ev::find($request->evid)->update([
            'name' => $request->name,
            'version' => $request->version,
            'percentindex' => $request->percentindex,
            'percentextra' => $request->percentextra
        ]);
        $ev = Ev::find($request->evid);
        return response()->json($ev); 
    }
    public function CommentEvStageone(Request $request){
        $auth = Auth::user();
        $evedithistory = new EvEditHistory();
        $evedithistory->ev_id  = $request->id;
        $evedithistory->historytype = 1;
        $evedithistory->detail = $request->comment;
        $evedithistory->user_id = Auth::user()->id;
        $evedithistory->save();
        $evedithistories = EvEditHistory::where('ev_id',$request->id)->get();

        Ev::find($request->id)->update(
            [
                'refixstatus' => 1
            ]
        );

        $ev = Ev::find($request->id);

        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        
        $notificationbubble = new NotificationBubble();
        $notificationbubble->business_plan_id = $businessplan->id;
        $notificationbubble->notification_category_id = 1;
        $notificationbubble->notification_sub_category_id = 5;
        $notificationbubble->user_id = $auth->id;
        $notificationbubble->target_user_id = $projectassignment->leader_id;
        $notificationbubble->save();

        $messagebox =  Message::sendMessage('ให้แก้ไข EV โครงการ'.$minitbp->project,'เรียน Leader<br><br> Manager ได้ตรวจสอบ EV โครงการ' . $minitbp->project . ' แล้วมีรายการแก้ไข โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.editev',['id' => $ev->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectassignment->leader_id);
        $alertmessage = new AlertMessage();
        $alertmessage->user_id = $auth->id;
        $alertmessage->target_user_id =  $projectassignment->leader_id;
        $alertmessage->messagebox_id = $messagebox->id;
        $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ให้แก้ไข EV ของโครงการ' . $minitbp->project.' <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.fulltbp.editev',['id' => $ev->id]).'>ดำเนินการ</a>';
        $alertmessage->save();

        MessageBox::find($messagebox->id)->update([
            'alertmessage_id' => $alertmessage->id
        ]);

        $evcommenttab = new EvCommentTab();
        $evcommenttab->ev_id = $request->id;
        $evcommenttab->stage = 1;
        $evcommenttab->status = 1;
        $evcommenttab->save();

        EmailBox::send(User::find($projectassignment->leader_id)->email,'TTRS:ให้แก้ไข EV โครงการ'.$minitbp->project,'เรียน Leader<br><br> Manager ได้ตรวจสอบ EV โครงการ' . $minitbp->project . ' แล้วมีรายการแก้ไข โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.fulltbp.editev',['id' => $ev->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
 
        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->action = 'ส่งคืนแก้ไขรายการ EV (รายละเอียด: ' .$request->comment. ')';
        $projectlog->save();

        CreateUserLog::createLog('ส่งคืนแก้ไข EV โครงการ' . $minitbp->project);
        return response()->json($evedithistories); 
    }
    public function DeleteEvComment(Request $request){
        $evedithistory = EvEditHistory::find($request->id);
        $evedithistoryid = $evedithistory->ev_id;
        $evedithistory->delete();
        $evedithistories = EvEditHistory::where('ev_id',$evedithistoryid)->get();
        return response()->json($evedithistories); 
    }
    public function ClearCommentTab(Request $request){
        EvCommentTab::where('ev_id',$request->id)->where('stage',$request->stage)->delete();
        return; 
    }

    public function CommentEvStagetwo(Request $request){
        $auth = Auth::user();
        $evedithistory = new EvEditHistory();
        $evedithistory->ev_id  = $request->id;
        $evedithistory->historytype = 2;
        $evedithistory->detail = $request->comment;
        $evedithistory->user_id = Auth::user()->id;
        $evedithistory->save();
        $evedithistories = EvEditHistory::where('ev_id',$request->id)->get();

        Ev::find($request->id)->update(
            [
                'refixstatus' => 1
            ]
        );

        $ev = Ev::find($request->id);
        // $admins = User::where('user_type_id',5)->pluck('id')->toArray();
        $admins = User::where('user_type_id',5)->get();
        // $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);

        $evcommenttab = new EvCommentTab();
        $evcommenttab->ev_id = $request->id;
        $evcommenttab->stage = 2;
        $evcommenttab->status = 1;
        $evcommenttab->save();

        foreach ($admins as $key => $admin) {
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 6;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $admin->id;
            $notificationbubble->save();
            
            $messagebox = Message::sendMessage('แก้ไข EV','Manager ได้ตรวจ EV สำหรับโครงการ  '.$minitbp->project.' มีรายละเอียดการแก้ไข <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>ดำเนินการ</a>',Auth::user()->id,$admin->id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->target_user_id =$admin->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' ให้แก้ไข EV ของโครงการ' . $minitbp->project . ' <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>ดำเนินการ</a> ';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send($admin->email,'TTRS:แก้ไข EV','เรียน Admin<br> Manager ได้ตรวจ EV สำหรับโครงการ '.$minitbp->project.' มีข้อแก้ไขดังนี้ '.$request->note.' ให้แก้ไขใหม่ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

            $projectlog = new ProjectLog();
            $projectlog->mini_tbp_id = $minitbp->id;
            $projectlog->user_id = $auth->id;
            $projectlog->action = 'ส่งคืนแก้ไข Weight ของ EV (รายละเอียด: ' .$request->comment. ')';
            $projectlog->save();

            CreateUserLog::createLog('ส่งคืนแก้ไข EV Weight โครงการ' . $minitbp->project);
        }
        return response()->json($evedithistories); 
    }

    public function ApproveEvStageTwo(Request $request){
        $auth = Auth::user();
        $ev = Ev::find($request->id);

        Ev::find($request->id)->update([
            'status' => 4,
            'refixstatus' => 0
        ]);
        $ev = Ev::find($request->id);
        // $admins = User::where('user_type_id',5)->pluck('id')->toArray();
        $admins = User::where('user_type_id',5)->get();
        // $projectsmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->whereIn('user_id',$admins)->get();
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $company = Company::find($businessplan->company_id);
        foreach ($admins as $key => $admin) {
            // $notificationbubble = new NotificationBubble();
            // $notificationbubble->business_plan_id = $businessplan->id;
            // $notificationbubble->notification_category_id = 1;
            // $notificationbubble->notification_sub_category_id = 6;
            // $notificationbubble->user_id = $auth->id;
            // $notificationbubble->target_user_id = $projectsmember->user_id;
            // $notificationbubble->save();
            
            $messagebox = Message::sendMessage('EV โครงการ' . $minitbp->project.' บริษัท' . $company->name .' ผ่านการอนุมัติ','Manager ได้อนุมัติ EV โครงการ' . $minitbp->project.' บริษัท' . $company->name .' โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>ดำเนินการ</a>',Auth::user()->id,$admin->id);
            $alertmessage = new AlertMessage();
            $alertmessage->user_id = $auth->id;
            $alertmessage->messagebox_id = $messagebox->id;
            $alertmessage->target_user_id =$admin->id;
            $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString(). ' EV ผ่านการอนุมัติ' . $minitbp->project .' บริษัท' . $company->name .' <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>ดำเนินการ</a> ';
            $alertmessage->save();

            MessageBox::find($messagebox->id)->update([
                'alertmessage_id' => $alertmessage->id
            ]);

            EmailBox::send($admin->email,'TTRS:EV โครงการ' . $minitbp->project.' บริษัท' . $company->name .' ผ่านการอนุมัติ','เรียน Admin<br> Manager ได้อนุมัติ EV สำหรับโครงการ '.$minitbp->project.' ตรวจสอบได้ที่ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.project.evweight.edit',['id' => $request->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());

            $projectlog = new ProjectLog();
            $projectlog->mini_tbp_id = $minitbp->id;
            $projectlog->user_id = $auth->id;
            $projectlog->action = 'อนุมัติ EV Weight';
            $projectlog->save();

            CreateUserLog::createLog('อนุมัติ EV Weight โครงการ' . $minitbp->project);
        }
        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',3)->first();
        if($projectstatustransaction->status == 1){
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
    }

    public function EditCriteriaTransactionComment(Request $request){
        CriteriaTransaction::find($request->transactionid)->update([
            'comment' => $request->comment
        ]);
        return ; 
    }
    public function EditExtraCriteriaTransactionComment(Request $request){
        ExtraCriteriaTransaction::find($request->transactionid)->update([
            'extracomment' => $request->comment
        ]);
        return ; 
    }
    public function EditWeightcomment(Request $request){
        PillaIndexWeigth::find($request->transactionid)->update([
            'comment' => $request->comment
        ]);
        return ; 
    }
    public function EditExtraWeightcomment(Request $request){
        ExtraCriteriaTransaction::find($request->transactionid)->update([
            'weightcomment' => $request->comment
        ]);
        return ; 
    }

    
    
}
