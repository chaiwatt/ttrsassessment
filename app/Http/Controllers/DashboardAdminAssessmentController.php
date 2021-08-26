<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\EvType;
use App\Model\Pillar;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Scoring;
use App\Helper\Message;
use App\Helper\EmailBox;
use App\Helper\UserArray;
use App\Model\MessageBox;
use App\Model\ProjectLog;
use App\Model\GeneralInfo;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\ExtraScoring;
use App\Helper\GetEvPercent;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use App\Model\ScoringStatus;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Helper\DateConversion;
use App\Model\TimeLineHistory;
use App\Model\CheckListGrading;
use App\Model\PillaIndexWeigth;
use App\Model\ProjectAssignment;
use App\Model\InvoiceTransaction;
use App\Model\NotificationBubble;
use App\Model\CriteriaTransaction;
use App\Model\ProjectMemberBackup;
use App\Model\SummaryExpertPercent;
use Illuminate\Support\Facades\Auth;
use App\Model\ExtraCriteriaTransaction;
use App\Model\ProjectStatusTransaction;

class DashboardAdminAssessmentController extends Controller
{
    public function Index(){
        $auth = Auth::user();


        NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',3) // notification_category_id 1 = โครงการ
                        ->where('notification_sub_category_id',9) // notification_sub_category_id 7 = การลงคะแนน
                        ->where('status',0)->delete();

        $projectmembers = ProjectMember::where('user_id',$auth->id)->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id', $projectmembers)->get();


        return view('dashboard.admin.assessment.index')->withFulltbps($fulltbps);
    }
   public function Edit($id){
        $fulltbp = FullTbp::find($id);
        $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
        return view('dashboard.admin.assessment.edit')->withEv($ev);
   }

   public function GetEv(Request $request){
        $subpillarindexarray = Scoring::where('ev_id',$request->evid)
                                    ->distinct('sub_pillar_index_id')
                                    ->where('scoretype',2)
                                    ->whereNotNull('user_id')
                                    ->pluck('sub_pillar_index_id')
                                    ->toArray();

        $basearray = array();  
        $projectmembers = ProjectMember::where('full_tbp_id',Ev::find($request->evid)->full_tbp_id)->get();                              
        foreach ($subpillarindexarray as $key => $subpillarindex) {
            $scores = array();
            $scores = Scoring::where('ev_id',$request->evid)
                        ->where('sub_pillar_index_id',$subpillarindex)
                        ->whereNotNull('user_id')
                        ->distinct('criteria_transaction_id')
                        ->pluck('criteria_transaction_id')
                        ->toArray();    
            $arrayrepeat = array();
            foreach($scores as $v) {
                $count = Scoring::where('ev_id',$request->evid)
                                ->where('sub_pillar_index_id',$subpillarindex)
                                ->whereNotNull('user_id')
                                ->where('criteria_transaction_id',$v)
                                ->where('scoretype',2)
                                ->count();
                
                $checksum = Scoring::where('ev_id',$request->evid)
                                ->where('sub_pillar_index_id',$subpillarindex)
                                ->whereNotNull('user_id')
                                ->where('criteria_transaction_id',$v)
                                ->where('scoretype',2)
                                ->sum('score');
                            
                if($checksum !=0 && $checksum !=$count){
                    $arrayrepeat[] = $v;
                }

            }
            $basearray = array_merge($arrayrepeat,$basearray); 
        }

        $subpillarindexarray = Scoring::where('ev_id',$request->evid)
                        ->whereNotNull('user_id')
                        ->distinct('sub_pillar_index_id')
                        ->where('scoretype',1)
                        ->pluck('sub_pillar_index_id')
                        ->toArray();
        foreach ($subpillarindexarray as $key => $subpillarindex) {
            $scores = Scoring::where('ev_id',$request->evid)
                        ->where('sub_pillar_index_id',$subpillarindex)
                        ->whereNotNull('user_id')
                        ->pluck('score')
                        ->toArray();   
                if(count(array_unique($scores)) != 1){
                    $basearray[] = Scoring::where('ev_id',$request->evid)
                                        ->where('sub_pillar_index_id',$subpillarindex)
                                        ->whereNotNull('user_id')
                                        ->first()
                                        ->criteria_transaction_id;
                }   
        }

        $extraxcorings = ExtraScoring::where('ev_id',$request->evid)
                                    ->distinct('extra_critreria_transaction_id')
                                    ->pluck('extra_critreria_transaction_id')
                                    ->toArray();
        $totaluser = ExtraScoring::where('ev_id',$request->evid)
                        ->distinct('sub_pillar_index_id')
                        ->pluck('user_id')
                        ->toArray(); 
    
        $diffcriterias = array();
        foreach ($extraxcorings as $key => $extraxcoring) {
            $array = array();
            $array = ExtraScoring::where('ev_id',$request->evid)
                            ->where('extra_critreria_transaction_id',$extraxcoring)
                            ->whereIn('user_id',$totaluser)
                            ->pluck('scoring')->toArray();

            if(count(array_unique($array)) !== 1){
                array_push($diffcriterias, $extraxcoring);
            }

        }

        $extracriteriatransactions = ExtraCriteriaTransaction::whereIn('id',$diffcriterias)
                                                        ->orderBy('extra_category_id', 'asc')
                                                        ->orderBy('extra_criteria_id', 'asc')
                                                        ->get()
                                                        ->append('extracategory')
                                                        ->append('extracriteria');  
        $criteriatransactions = CriteriaTransaction::whereIn('id',array_unique($basearray))
                                                    ->orderBy('pillar_id','asc')
                                                    ->orderBy('sub_pillar_id', 'asc')
                                                    ->orderBy('sub_pillar_index_id', 'asc')
                                                    ->get()
                                                    ->makeHidden('scoring');

        $fulltbp = FullTbp::find(Ev::find($request->evid)->full_tbp_id);
        $projectmembers = ProjectMember::where('full_tbp_id',$fulltbp->id)->get(); 
        $ev = Ev::find($request->evid);
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "projectmembers" => $projectmembers,
            "extracriteriatransactions" => $extracriteriatransactions
        ));
    }

    public function AddScore(Request $request){
        $scoring = Scoring::where('criteria_transaction_id',$request->transactionid)
                        ->where('user_id',Auth::user()->id)
                        ->first();
        $criteriatransaction = CriteriaTransaction::find($request->transactionid);
        if(Empty($scoring)){
            $scoring = new Scoring();
            $scoring->ev_id = $criteriatransaction->ev_id;
            $scoring->criteria_transaction_id = $request->transactionid;
            $scoring->sub_pillar_index_id = $request->subpillarindex;
            $scoring->scoretype = $request->scoretype;
            $scoring->score = $request->score;
            $scoring->user_id = Auth::user()->id;
            $scoring->save();
        }else{
            if($request->scoretype == 2 && $request->score == 0){
                $scoring->update([
                    'score' => 0
                ]);
            }else{
                $scoring->update([
                    'score' => $request->score
                ]);
            }
        }
        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$criteriatransaction->ev_id)
                                        ->where('sub_pillar_index_id',$criteriatransaction->sub_pillar_index_id)
                                        ->first();
        $pillar = Pillar::find($criteriatransaction->pillar_id);   
        $evportion = EvType::find(1);                          
        $weightsum = 0;
        $numcheck = 0;
        if(strtoupper(trim($request->score)) == 'A'){
            $weightsum = ($pillaindexweigth->weigth)*5*($pillar->percent/100)*($evportion->percent/100);
        }else if(strtoupper(trim($request->score)) == 'B'){
            $weightsum = ($pillaindexweigth->weigth)*4*($pillar->percent/100)*($evportion->percent/100);
        }else if(strtoupper(trim($request->score)) == 'C'){
            $weightsum = ($pillaindexweigth->weigth)*3*($pillar->percent/100)*($evportion->percent/100);
        }else if(strtoupper(trim($request->score)) == 'D'){
            $weightsum = ($pillaindexweigth->weigth)*2*($pillar->percent/100)*($evportion->percent/100);
        }else if(strtoupper(trim($request->score)) == 'E'){
            $weightsum = ($pillaindexweigth->weigth)*1*($pillar->percent/100)*($evportion->percent/100);
        }else if(strtoupper(trim($request->score)) == '0' || 
                strtoupper(trim($request->score)) == '1' || 
                strtoupper(trim($request->score)) == '2'){
            $numcheck = Scoring::where('ev_id',$criteriatransaction->ev_id)
                            ->where('sub_pillar_index_id',$criteriatransaction->sub_pillar_index_id)
                            ->where('scoretype',2)
                            ->where('user_id',Auth::user()->id)
                            ->get()->sum('score');   
            $checklistgrading = CheckListGrading::where('ev_id',$criteriatransaction->ev_id)
                            ->where('sub_pillar_index_id',$criteriatransaction->sub_pillar_index_id)->first(); 
            $grades=array($checklistgrading->gradea,$checklistgrading->gradeb,$checklistgrading->gradec,$checklistgrading->graded,$checklistgrading->gradee);    
            $gradeis = 0;
            foreach ($grades as $key => $grade) {
                if($numcheck <= $grade){
                    $gradeis = $key;
                break;
                }
            }
            if($gradeis == 0){
                $weightsum = ($pillaindexweigth->weigth)*5*($pillar->percent/100)*($evportion->percent/100);
            }else if($gradeis == 1){
                $weightsum = ($pillaindexweigth->weigth)*4*($pillar->percent/100)*($evportion->percent/100);
            }else if($gradeis == 2){
                $weightsum = ($pillaindexweigth->weigth)*3*($pillar->percent/100)*($evportion->percent/100);
            }else if($gradeis == 3){
                $weightsum = ($pillaindexweigth->weigth)*2*($pillar->percent/100)*($evportion->percent/100);
            }else if($gradeis == 4){
                $weightsum = ($pillaindexweigth->weigth)*1*($pillar->percent/100)*($evportion->percent/100);
            }
        }
        $pillars = Pillar::get();   
        $evportions = EvType::get();   
        $subpillarindexarray = Scoring::where('ev_id',$criteriatransaction->ev_id)
                                    ->whereNotNull('user_id')
                                    ->distinct('sub_pillar_index_id')
                                    ->where('scoretype',2)
                                    ->pluck('sub_pillar_index_id')
                                    ->toArray();
                
        $basearray = array();     
        $projectmembers = ProjectMember::where('full_tbp_id',Ev::find($criteriatransaction->ev_id)->full_tbp_id)->get();                     
        foreach ($subpillarindexarray as $key => $subpillarindex) {
            $scores = Scoring::where('sub_pillar_index_id',$subpillarindex)
                            ->whereNotNull('user_id')
                            ->pluck('criteria_transaction_id')
                            ->toArray();   
            $val_count = array_count_values($scores);
            $repeat = $projectmembers->count();
            $arrayrepeat = array();
            foreach($scores as $v) {
              if ($val_count[$v] < $repeat) $arrayrepeat[] = $v;
            }
            
            $basearray = array_merge($arrayrepeat,$basearray);
        }

        $subpillarindexarray = Scoring::where('ev_id',$criteriatransaction->ev_id)
                                    ->whereNotNull('user_id')
                                    ->distinct('sub_pillar_index_id')
                                    ->where('scoretype',1)
                                    ->pluck('sub_pillar_index_id')
                                    ->toArray();

        foreach ($subpillarindexarray as $key => $subpillarindex) {
            $scores = Scoring::where('sub_pillar_index_id',$subpillarindex)
                            ->whereNotNull('user_id')
                            ->pluck('score')
                            ->toArray();   
            if(count(array_unique($scores)) != 1){
                $basearray[] = Scoring::where('ev_id',$criteriatransaction->ev_id)
                                    ->whereNotNull('user_id')
                                    ->where('sub_pillar_index_id',$subpillarindex)
                                    ->first()
                                    ->criteria_transaction_id;
            }   
        }

        $criteriatransactions = CriteriaTransaction::whereIn('id',array_unique($basearray))
                                ->orderBy('pillar_id','asc')
                                ->orderBy('sub_pillar_id', 'asc')
                                ->orderBy('sub_pillar_index_id', 'asc')
                                ->get();

        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$criteriatransaction->ev_id)->get();
        $sumweigth = round(PillaIndexWeigth::where('ev_id',$criteriatransaction->ev_id)->sum('weigth'), 4); 
        $pillars = Pillar::get();   
        $evportions = EvType::get();   

        $scores = Scoring::where('ev_id',$criteriatransaction->ev_id)
                        ->whereNotNull('user_id')
                        ->where('scoretype',2)
                        ->get();
        $checklistgradings = CheckListGrading::where('ev_id',$criteriatransaction->ev_id)->get(); 
        $fulltbp = FullTbp::find(Ev::find($criteriatransaction->ev_id)->full_tbp_id);
        $projectmembers = ProjectMember::where('full_tbp_id',$fulltbp->id)->get(); 
        return response()->json(array(
                "criteriatransactions" => $criteriatransactions,
                "pillaindexweigths" => $pillaindexweigths,
                "sumweigth" => $sumweigth,
                "pillars" => $pillars,
                "evportions" => $evportions,
                "scores" => $scores,
                "checklistgradings" => $checklistgradings,
                "projectmembers" => $projectmembers,
                "weightsum" => $weightsum
        ));
    }

    public function ConflictScore(Request $request){
        $criteriatransaction = CriteriaTransaction::find($request->id);
        $scores = Scoring::where('ev_id',$criteriatransaction->ev_id)
                        ->whereNotNull('user_id')
                        ->where('scoretype',2)
                        ->where('criteria_transaction_id',$request->id)
                        ->get();  
        $projectmembers = Projectmember::where('full_tbp_id',Ev::find($criteriatransaction->ev_id)->full_tbp_id)->get();              
        return response()->json(array(
            "scores" => $scores,
            "projectmembers" => $projectmembers
    ));
    }

    
    public function ConflictGrade(Request $request){
        $criteriatransaction = CriteriaTransaction::find($request->id);
        $scores = Scoring::where('ev_id',$criteriatransaction->ev_id)
                        ->whereNotNull('user_id')
                        ->where('scoretype',1)
                        ->where('sub_pillar_index_id',$criteriatransaction->sub_pillar_index_id)
                        ->get()->each->append('user');                       
        return response()->json($scores); 
    }

    public function PendingUser(Request $request){
        $ev = Ev::where('full_tbp_id',$request->id)->first();
        $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
        $projectmembers = ProjectMember::where('full_tbp_id',$request->id)->pluck('user_id')->toArray();
        $pending = array_diff($projectmembers,$scoringstatuses);
        $users = User::whereIn('id',$pending)->get();
        return response()->json($users); 
    }

    public function UpdateScore(Request $request){ 
        $auth = Auth::user(); 
        if($request->arraylist != null){
            foreach ($request->arraylist as $key => $criteria) {
                if($criteria['scoretype'] == 1){
                    $scores = Scoring::where('ev_id',$criteria['evid'])
                                    ->whereNull('user_id')
                                    ->where('scoretype',1)
                                    ->where('criteria_transaction_id',$criteria['criteriatransactionid'])
                                    ->where('sub_pillar_index_id',$criteria['subpillarindex'])
                                    ->first()->update([
                                        'score' => $criteria['value']
                                    ]); 

                }elseif($criteria['scoretype'] == 2){
                    $score = Scoring::where('ev_id',$criteria['evid'])
                                    ->whereNull('user_id')
                                    ->where('scoretype',2)
                                    ->where('criteria_transaction_id',$criteria['criteriatransactionid'])
                                    ->where('sub_pillar_index_id',$criteria['subpillarindex'])
                                    ->first();  
                    // if(Empty($score)){
                    //     if($criteria['value'] == 'true'){
                    //         $score = new Scoring();
                    //         $score->ev_id = $criteria['evid'];
                    //         $score->criteria_transaction_id  = $criteria['criteriatransactionid'];
                    //         $score->sub_pillar_index_id = $criteria['subpillarindex'];
                    //         $score->scoretype = 2;
                    //         $score->score = 1;
                    //         $score->save();
                    //     }
                    // }else{
                        if($criteria['value'] == 0){
                            // Scoring::where('ev_id',$criteria['evid'])
                            //         ->whereNull('user_id')
                            //         ->where('scoretype',2)
                            //         ->where('criteria_transaction_id',$criteria['criteriatransactionid'])
                            //         ->where('sub_pillar_index_id',$criteria['subpillarindex'])
                            //         ->first()->delete(); 
                            $score->update([
                                'score' => 0
                            ]);
                        } else if($criteria['value'] == 1){
                            $score->update([
                                'score' => 1
                            ]);
                        }
                    //}                
                }
            }
        }

        if ($request->conflictcommentarray != null) {
            foreach ($request->conflictcommentarray as $key => $comment) {
                Scoring::where('ev_id',$comment['evid'])
                            ->whereNull('user_id')
                            ->where('criteria_transaction_id',$comment['criteriatransactionid'])
                            ->where('sub_pillar_index_id',$comment['subpillarindex'])
                            ->first()->update([
                                'comment' => $comment['value']
                            ]); 
            }
        }


         $existingarray = array(); 
         if($request->extraarraylist != null){
            foreach ($request->extraarraylist as $key => $extracriteria) {
                $comment = $request->extracommnetarraylist[$key]['value'];
                array_push($existingarray, $extracriteria['extracriteriatransactionid']);
                $extrascore = new ExtraScoring();
                $extrascore->ev_id = $extracriteria['evid'];
                $extrascore->extra_critreria_transaction_id = $extracriteria['extracriteriatransactionid'];
                $extrascore->scoring  = $extracriteria['value'];
                $extrascore->comment  = $comment;
                $extrascore->save();
            }
          }
        $extrascoringarray = ExtraScoring::where('ev_id',$request->evid)
                    ->whereNotIn('extra_critreria_transaction_id',$existingarray)
                    ->distinct('extra_critreria_transaction_id')
                    ->pluck('extra_critreria_transaction_id')
                    ->toArray();

        if(count($extrascoringarray) > 0){
            foreach ($extrascoringarray as $key => $_extrascore) {
                $check = ExtraScoring::where('ev_id',$request->evid)->where('extra_critreria_transaction_id',$_extrascore)->first();
                $extrascore = new ExtraScoring();
                $extrascore->ev_id = $check->ev_id;
                $extrascore->extra_critreria_transaction_id = $check->extra_critreria_transaction_id;
                $extrascore->scoring  = $check->scoring;
                $extrascore->save();
            }
        }            

        Ev::find($request->evid)->update([
            'status' => 5
        ]);
        $ev = Ev::find($request->evid);
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        BusinessPlan::find($minitbp->business_plan_id)->update([
            'business_plan_status_id' => 8
        ]);
        FullTbp::find($ev->full_tbp_id)->update([
            'finishdate' => Carbon::now()->toDateString()
        ]);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();


        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $company = Company::find($businessplan->company_id);
        $generalinfo = GeneralInfo::first();
        if($generalinfo->use_invoice_status_id == 2){
            // $notificationbubble = new NotificationBubble();
            // $notificationbubble->business_plan_id = $businessplan->id;
            // $notificationbubble->notification_category_id = 1;
            // $notificationbubble->notification_sub_category_id = 3;
            // $notificationbubble->user_id = $auth->id;
            // $notificationbubble->target_user_id = $projectassignment->leader_id;
            // $notificationbubble->save();
            
            // BusinessPlan::find($minitbp->business_plan_id)->update([
            //     'business_plan_status_id' => 9
            // ]);
        }else{
            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 1;
            $notificationbubble->notification_sub_category_id = 3;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $projectassignment->leader_id;
            $notificationbubble->save();

            $invoicetransaction = new InvoiceTransaction();
            $invoicetransaction->company_id = $company->id;
            $invoicetransaction->mini_tbp_id = $minitbp->id;
            $invoicetransaction->customer = $company->name;
            $invoicetransaction->issuedate = Carbon::now()->toDateString();
            $invoicetransaction->saleorderdate = Carbon::now()->toDateString();
            $invoicetransaction->description = 'ค่าธรรมเนียมการประเมินเทคโนโลยี';
            $invoicetransaction->price = 0;
            $invoicetransaction->save();
        }

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

        $projectmembers = ProjectMember::where('full_tbp_id',$ev->full_tbp_id)->get();
        foreach ($projectmembers as $key => $projectmember) {
            $_user = User::find($projectmember->user_id);
            $summaryexpertpercent = new SummaryExpertPercent();
            $summaryexpertpercent->ev_id = $ev->id;
            $summaryexpertpercent->user_id = $projectmember->user_id;
            $summaryexpertpercent->percent = GetEvPercent::getEvPercent($projectmember->user_id,$ev->full_tbp_id); 
            $summaryexpertpercent->save();

            $notificationbubble = new NotificationBubble();
            $notificationbubble->business_plan_id = $businessplan->id;
            $notificationbubble->notification_category_id = 3;
            $notificationbubble->notification_sub_category_id = 10;
            $notificationbubble->user_id = $auth->id;
            $notificationbubble->target_user_id = $projectmember->user_id;
            $notificationbubble->save();

            $isleader = ProjectAssignment::where('full_tbp_id',$ev->full_tbp_id)->where('leader_id',$projectmember->user_id)->first();
            if(!(Empty($isleader)) || $_user->user_type_id >=5){
                $messagebox = Message::sendMessage('สรุปผลการประเมิน โครงการ'.$minitbp->project . $fullcompanyname,'ผู้เชี่ยวชาญได้สรุปคะแนนการประเมิน โครงการ'.$minitbp->project . $fullcompanyname.' เสร็จเรียบร้อยแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.assessment.summary',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectmember->user_id);

                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id = $projectmember->user_id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' ผู้เชี่ยวชาญได้สรุปคะแนนการประเมิน โครงการ'.$minitbp->project . $fullcompanyname.' เสร็จเรียบร้อยแล้ว โปรดตรวจสอบ <a data-id="'.$messagebox->id.'" class="btn btn-sm bg-success linknextaction" href='.route('dashboard.admin.assessment.summary',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
                $alertmessage->save();
        
                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);
        
                EmailBox::send($_user->email,'','TTRS: สรุปผลการประเมิน โครงการ'.$minitbp->project  . $fullcompanyname,'เรียน คุณ'.$_user->name .' '.$_user->lastname.' <br><br> ทีมผู้เชี่ยวชาญได้สรุปคะแนนการประเมิน โครงการ'.$minitbp->project . $fullcompanyname.' เสร็จเรียบร้อยแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.assessment.summary',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
            }else{
                $messagebox = Message::sendMessage('สรุปผลการประเมิน โครงการ'.$minitbp->project . $fullcompanyname,'ผู้เชี่ยวชาญได้สรุปคะแนนการประเมิน โครงการ'.$minitbp->project . $fullcompanyname.' เสร็จเรียบร้อยแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.assessment.summary',['id' => $fulltbp->id]).'>ดำเนินการ</a>',Auth::user()->id,$projectmember->user_id);

                $alertmessage = new AlertMessage();
                $alertmessage->user_id = $auth->id;
                $alertmessage->target_user_id = $projectmember->user_id;
                $alertmessage->messagebox_id = $messagebox->id;
                $alertmessage->detail = DateConversion::engToThaiDate(Carbon::now()->toDateString()) . ' ' . Carbon::now()->toTimeString().' ผู้เชี่ยวชาญได้สรุปคะแนนการประเมิน โครงการ'.$minitbp->project . $fullcompanyname.' เสร็จเรียบร้อยแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.assessment.summary',['id' => $fulltbp->id]).'>ดำเนินการ</a>';
                $alertmessage->save();
        
                MessageBox::find($messagebox->id)->update([
                    'alertmessage_id' => $alertmessage->id
                ]);
        
                EmailBox::send($_user->email,'','TTRS: สรุปผลการประเมิน โครงการ'.$minitbp->project  . $fullcompanyname,'เรียน คุณ'.$_user->name .' '.$_user->lastname.' <br><br> ทีมผู้เชี่ยวชาญได้สรุปคะแนนการประเมิน โครงการ'.$minitbp->project . $fullcompanyname.' เสร็จเรียบร้อยแล้ว โปรดตรวจสอบ <a class="btn btn-sm bg-success" href='.route('dashboard.admin.assessment.summary',['id' => $fulltbp->id]).'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        
            }
        }

        $projectstatustransaction = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',5)->first();
        if($projectstatustransaction->status == 1){
            $projectstatustransaction->update([
                'status' => 2
            ]);
            $projectstatustransaction = new ProjectStatusTransaction();
            $projectstatustransaction->mini_tbp_id = $minitbp->id;
            $projectstatustransaction->project_flow_id = 6;
            $projectstatustransaction->save();

            DateConversion::addExtraDay($minitbp->id,5);
        }

        ProjectStatus::where('mini_tbp_id',$minitbp->id)->where('project_flow_id',5)->first()->update([
            'actual_startdate' =>  Carbon::now()->toDateString()
        ]);

        $arr1 = UserArray::projectmember($minitbp->business_plan_id);
        $arr2 = UserArray::adminandjd($minitbp->business_plan_id);
        $arr3 = UserArray::leader($minitbp->business_plan_id);
        $userarray = array_unique(array_merge($arr1,$arr2,$arr3));
        
        $timeLinehistory = new TimeLineHistory();
        $timeLinehistory->business_plan_id = $minitbp->business_plan_id;
        $timeLinehistory->mini_tbp_id = $minitbp->id;
        $timeLinehistory->details = 'TTRS: สรุปผลการประเมินสำเร็จ';
        $timeLinehistory->message_type = 3;
        $timeLinehistory->viewer = $userarray;
        $timeLinehistory->owner_id = $auth->id;
        $timeLinehistory->user_id = $auth->id;
        $timeLinehistory->save();

        $projectlog = new ProjectLog();
        $projectlog->mini_tbp_id = $minitbp->id;
        $projectlog->user_id = $auth->id;
        $projectlog->viewer = $userarray;
        $projectlog->action = 'สรุปคะแนนสำเร็จ';
        $projectlog->save();

        CreateUserLog::createLog('สรุปคะแนน โครงการ' . $minitbp->project);
    }

    public function Summary($id){
        $ev = Ev::where('full_tbp_id',$id)->first();
        return view('dashboard.admin.assessment.summary')->withEv($ev);
    }

    public function DoAccessment(){
        $eventcalendars = EventCalendar::whereNotNull('eventdate')
                                    ->whereNotNull('starttime')
                                    ->whereNotNull('endtime')
                                    ->whereNotNull('place')
                                    ->whereNotNull('summary')
                                    // ->where('calendar_type_id',3)
                                    ->get();
        // foreach ($eventcalendars as $key => $eventcalendar) {
        //         $ev = Ev::where('full_tbp_id',$eventcalendar->full_tbp_id)->first();
        //         $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
        //         $date = Carbon::parse($eventcalendar->eventdate);
        //         if($date->isToday() == 1){
        //             if (count($scoringstatuses) == 0) {
        //                 $_projectmembers = ProjectMember::where('full_tbp_id',$eventcalendar->full_tbp_id)->get();
        //                 foreach ($_projectmembers as $key => $_projectmember) {
        //                     $new = new ProjectMemberBackup();
        //                     $new->full_tbp_id = $_projectmember->full_tbp_id;
        //                     $new->user_id = $_projectmember->user_id;
        //                     $new->save(); 
        //                 }
        //             }
        //             ProjectMember::whereNotIn('user_id',$scoringstatuses)->where('full_tbp_id',$eventcalendar->full_tbp_id)->delete();
        //             $check = Scoring::where('ev_id',$ev->id)
        //                             ->whereNull('user_id')
        //                             ->get(); 
        //             if($check->count() == 0){
        //                 $user = Scoring::where('ev_id',$ev->id)
        //                         ->whereNotNull('user_id')
        //                         ->first(); 
        //                 if(!Empty($user)){
        //                     $scorings = Scoring::where('ev_id',$ev->id)
        //                             ->where('user_id',$user->id)
        //                             ->get(); 
        //                     foreach ($scorings as $key => $scoring) {
        //                         $_check = Scoring::where('ev_id',$scoring->ev_id)
        //                                     ->where('criteria_transaction_id',$scoring->criteria_transaction_id)
        //                                     ->where('sub_pillar_index_id',$scoring->sub_pillar_index_id)
        //                                     ->where('scoretype',$scoring->scoretype)
        //                                     ->whereNull('user_id')
        //                                     ->where('score',$scoring->score)->first();
        //                         if(Empty($_check)){
        //                             $new = new Scoring();
        //                             $new->ev_id = $scoring->ev_id;
        //                             $new->criteria_transaction_id  = $scoring->criteria_transaction_id ;
        //                             $new->sub_pillar_index_id = $scoring->sub_pillar_index_id;
        //                             $new->scoretype = $scoring->scoretype;
        //                             $new->score = $scoring->score;
        //                             $new->save();
        //                         } 
        //                     } 
        //                     $fulltbp = FullTbp::find($eventcalendar->full_tbp_id)->update([
        //                         'done_assessment' => 1
        //                     ]); 
        //                 }
     
        //             }
        //         }
        // }


        foreach ($eventcalendars as $key => $eventcalendar) {
            if($eventcalendar->calendar_type_id == 3){
                $ev = Ev::where('full_tbp_id',$eventcalendar->full_tbp_id)->first();
                $scoringstatuses = ScoringStatus::where('ev_id',$ev->id)->pluck('user_id')->toArray();
                $date = Carbon::parse($eventcalendar->eventdate);
                if($date->isToday() == 1){
                    if (count($scoringstatuses) == 0) {
                        $_projectmembers = ProjectMember::where('full_tbp_id',$eventcalendar->full_tbp_id)->get();
                        foreach ($_projectmembers as $key => $_projectmember) {
                            $new = new ProjectMemberBackup();
                            $new->full_tbp_id = $_projectmember->full_tbp_id;
                            $new->user_id = $_projectmember->user_id;
                            $new->save(); 
                        }
                    }
                    ProjectMember::whereNotIn('user_id',$scoringstatuses)->where('full_tbp_id',$eventcalendar->full_tbp_id)->delete();
                    $check = Scoring::where('ev_id',$ev->id)
                                    ->whereNull('user_id')
                                    ->get(); 
                    if($check->count() == 0){
                        $checkscoring = Scoring::where('ev_id',$ev->id)
                                ->whereNotNull('user_id')
                                ->first(); 
                        if(!Empty($checkscoring)){    
                            $scorings = Scoring::where('ev_id',$ev->id)
                                ->where('user_id',$checkscoring->user_id)
                                ->get(); 
                            foreach ($scorings as $key => $scoring) {
                                $new = new Scoring();
                                $new->ev_id = $scoring->ev_id;
                                $new->criteria_transaction_id  = $scoring->criteria_transaction_id ;
                                $new->sub_pillar_index_id = $scoring->sub_pillar_index_id;
                                $new->scoretype = $scoring->scoretype;
                                $new->score = $scoring->score;
                                $new->save();
                            } 
                            $fulltbp = FullTbp::find($eventcalendar->full_tbp_id)->update([
                                'done_assessment' => 1
                            ]); 
                        }        
                    }
                }
            }
        }
        return redirect()->back()->withSuccess('ปลดล็อคเวลาสรุปคะแนน วันนี้สำเร็จ');

    }

    public function ReScoring(Request $request){
        $projectmemberbackups = ProjectMemberBackup::where('full_tbp_id',$request->fulltbpid)->get();
        
        foreach ($projectmemberbackups as $key => $projectmemberbackup) {
            $new = new ProjectMember();
            $new->full_tbp_id  = $projectmemberbackup->full_tbp_id;
            $new->user_id  = $projectmemberbackup->user_id;
            $new->save();
        }
        EventCalendar::where('full_tbp_id',$request->fulltbpid)->where('calendar_type_id',3)->first()->update([
            'eventdate' => $request->eventdate
        ]);

        FullTbp::find($request->fulltbpid)->update([
             'scoringdate' => $request->eventdate
        ]);

        ProjectMemberBackup::where('full_tbp_id',$request->fulltbpid)->delete();
    }    

}
