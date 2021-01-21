<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Ev;
use App\Model\EvType;
use App\Model\Pillar;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Scoring;
use App\Model\Criteria;
use App\Helper\EmailBox;
use App\Model\FinalGrade;
use App\Model\BusinessPlan;
use App\Model\ExtraScoring;
use App\Model\GradeSummary;
use App\Model\ProjectGrade;
use App\Model\ProjectMember;
use App\Model\ScoringStatus;
use Illuminate\Http\Request;
use App\Model\ProjectScoring;
use App\Model\CheckListGrading;
use App\Model\PillaIndexWeigth;
use App\Model\ProjectAssignment;
use App\Model\CriteriaTransaction;
use Illuminate\Support\Facades\Auth;
use App\Model\CriteriaGroupTransaction;
use App\Model\ExtraCriteriaTransaction;

class DashboardAdminProjectAssessmentController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        // $fulltbps = FullTbp::where('status',2)->get();
        // if($auth->user_type_id < 6){
        //     $businessplanids = ProjectAssignment::where('leader_id',$auth->id)
        //                                     ->orWhere('coleader_id',$auth->id)
        //                                     ->pluck('business_plan_id')
        //                                     ->toArray();
        //     $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
        //     $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        // }
       
        $projectmembers = ProjectMember::where('user_id',$auth->id)->pluck('full_tbp_id')->toArray();
        // return $projectmembers;
        $fulltbps = FullTbp::whereIn('id', $projectmembers)->get();
        return view('dashboard.admin.project.assessment.index')->withFulltbps($fulltbps);
    }
    public function Edit($id,$userid){
        $fulltbp = FullTbp::find($id);
        $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
        $scoringstatus = ScoringStatus::where('ev_id',$ev->id)
                                    ->where('user_id',$userid)
                                    ->first(); 
        $user = User::find($userid);   
        $projectgrade = ProjectGrade::where('full_tbp_id',$fulltbp->id)->get();                         
        return view('dashboard.admin.project.assessment.edit')->withEv($ev)
                                                            ->withScoringstatus($scoringstatus)
                                                            ->withUser($user)
                                                            ->withProjectgrade($projectgrade);
    }

    public function EditSave(Request $request, $id){
        $fulltbp = FullTbp::find($id);
        foreach ($request->criterias as $key => $criteria) {
            $check = ProjectScoring::where('full_tbp_id',$fulltbp->id)->where('user_id',Auth::user()->id)->where('criteria_group_id',$fulltbp->criteria_group_id)->where('criteria_id',$key)->first();
            if(Empty($check)){
                $projectscoring = new ProjectScoring();
                $projectscoring->full_tbp_id = $fulltbp->id;
                $projectscoring->criteria_group_id = $fulltbp->criteria_group_id;
                $projectscoring->criteria_id = $key;
                $projectscoring->user_id = Auth::user()->id;
                $projectscoring->score = $criteria;
                $projectscoring->sumscore = $criteria*(CriteriaGroupTransaction::where('criteria_group_id',$fulltbp->criteria_group_id)->where('criteria_id',$key)->first()->weight);
                $projectscoring->save(); 
            }else{
                $check->update([
                    'score' => $criteria,
                    'sumscore' => $criteria*(CriteriaGroupTransaction::where('criteria_group_id',$fulltbp->criteria_group_id)->where('criteria_id',$key)->first()->weight)
                ]);
            }
        }
        $businessplan = BusinessPlan::find(MiniTBP::find(FullTbp::find($id)->mini_tbp_id)->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $existing_array = ProjectScoring::where('full_tbp_id',$fulltbp->id)->where('criteria_group_id',$fulltbp->criteria_group_id)->distinct('user_id')->pluck('user_id')->toArray();
        $users = array();
        $users = User::where('user_type_id','>=',6)->pluck('id')->toArray();
        array_push($users, $projectassignment->leader_id, $projectassignment->coleader_id);
        $unique_array = array_diff($users, $existing_array);
        $mails = array();
        foreach($users as $user){
            $_user = User::find($user);
            $mails[] = $_user->email;
        }
        $pending ='';
        foreach($unique_array as $user){
            $_user = User::find($user);
            $pending .= 'คุณ' . $_user->name . '  ' .  $_user->lastname . ',';
        }
        
        EmailBox::send($mails,'TTRS:มีการลงคะแนนโครงการ','เรียนท่านคณะกรรมการ <br><br> มีการลงคะแนนโครงการ' .MiniTBP::find(FullTbp::find($id)->mini_tbp_id)->project.  '' .
        '<br><strong>&nbsp;โดย:</strong> คุณ'.Auth::user()->name. '  ' . Auth::user()->lastname .
        '<br><strong>&nbsp;ผู้ที่ยังไม่ได้ลงคะแนน:</strong> '.$pending. 
        '<br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
        return redirect()->route('dashboard.admin.project.assessment')->withSuccess('ลงคะแนนสำเร็จ');
    }

    public function GetEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('ev_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get()
                                                ->makeHidden(['updated_at','created_at'])
                                                ->makeHidden('sumscoring');
        $sumweigth = round(PillaIndexWeigth::where('ev_id',$request->evid)->where('ev_type_id',1)->sum('weigth'), 4); 
        $pillars = Pillar::get(['id', 'ev_type_id']);   
        $scoringstatus = ScoringStatus::where('ev_id',$request->evid)
                                    ->where('user_id',$request->userid)
                                    ->first(['ev_id', 'user_id']);  
        $extracriteriatransactions = ExtraCriteriaTransaction::where('ev_id',$request->evid)
                                    ->orderBy('extra_category_id', 'asc')
                                    ->orderBy('extra_criteria_id', 'asc')
                                    ->get()
                                    ->append('extracategory')
                                    ->append('extracriteria'); 
        $extrascoring = ExtraScoring::where('ev_id',$request->evid)
                                    ->get();                             
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "sumweigth" => $sumweigth,
            "pillars" => $pillars,
            "scoringstatus" => $scoringstatus,
            "extracriteriatransactions" => $extracriteriatransactions,
            "extrascoring" => $extrascoring
        ));
    }

    public function GetSummaryEv(Request $request){
        $ev = Ev::find($request->evid);
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get()
                                                ->makeHidden(['updated_at','created_at']);
        GradeSummary::where('ev_id',$request->evid)->delete();
        for ($i=1; $i <= 2; $i++) {                                       
            $criteriatransactiongradings = CriteriaTransaction::where('ev_id',$request->evid)
                                                    ->where('index_type_id',1)
                                                    ->where('ev_type_id',$i)
                                                    ->get();
            
            $pillars = Pillar::where('ev_type_id',$i)->get();
            foreach ($criteriatransactiongradings as $key => $criteriatransactiongrading) {
                foreach ($pillars as $key => $pillar) {
                    $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)
                                    ->where('pillar_id',$pillar->id)
                                    ->where('sub_pillar_id',$criteriatransactiongrading->sub_pillar_id)
                                    ->where('sub_pillar_index_id',$criteriatransactiongrading->sub_pillar_index_id)->first();
                    if(!Empty($pillaindexweigth)){
                        $inscore = Scoring::where('ev_id',$request->evid)
                                        ->where('scoretype',1)
                                        ->where('criteria_transaction_id',$criteriatransactiongrading->id)
                                        ->where('sub_pillar_index_id',$criteriatransactiongrading->sub_pillar_index_id)
                                        ->whereNull('user_id')->first();               
                        if(!Empty($inscore)){
                            if($inscore->score == 'A' || $inscore->score == '5'){
                                $yourgrade = 5;
                            }else if($inscore->score == 'B' || $inscore->score == '4'){
                                $yourgrade = 4;
                            }else if($inscore->score == 'C' || $inscore->score == '3'){
                                $yourgrade = 3;
                            }else if($inscore->score == 'D' || $inscore->score == '2'){
                                $yourgrade = 2;
                            }else if($inscore->score == 'E' || $inscore->score == '1'){
                                $yourgrade = 1;
                            }else{
                                $yourgrade = 0;
                            }            
                            $gradesummary = new GradeSummary();
                            $gradesummary->full_tbp_id = $ev->full_tbp_id;
                            $gradesummary->ev_id = $ev->id;
                            $gradesummary->ev_type_id = $i;
                            $gradesummary->pillar_id = $pillar->id;
                            $gradesummary->grade = $inscore->score;
                            $gradesummary->weight = $pillaindexweigth->weigth;
                            $gradesummary->weightsum = floatval($yourgrade) * floatval($pillaindexweigth->weigth);
                            $gradesummary->save();
                        }
                    }
                }
            }

            $uniquecriteriatransactionchecklists = CriteriaTransaction::where('ev_id',$request->evid)
                                        ->where('index_type_id',2)
                                        ->select('id')
                                        ->groupBy('pillar_id')
                                        ->groupBy('sub_pillar_id')
                                        ->groupBy('sub_pillar_index_id')
                                        ->get();
            $pillars = Pillar::where('ev_type_id',$i)->get();
        
            
            foreach ($uniquecriteriatransactionchecklists as $key => $value) {
                foreach ($pillars as $key => $pillar) {
                    $demo = CriteriaTransaction::find($value->id);
                    $count = CriteriaTransaction::where('ev_id',$request->evid)
                                            ->where('pillar_id',$pillar->id)
                                            ->where('sub_pillar_id',$demo->sub_pillar_id)
                                            ->where('sub_pillar_index_id',$demo->sub_pillar_index_id)->pluck('id');
                    if(count($count)>0){
                        $inscore = Scoring::where('ev_id',$request->evid)->whereIn('criteria_transaction_id',$count)->whereNull('user_id')->pluck('criteria_transaction_id');
                        $_transactions = CriteriaTransaction::whereIn('id',$inscore)->get();
                        $_sumscore = 0;
                        foreach ($_transactions as $key => $_transaction) {
                            $_criteria = Criteria::find($_transaction->criteria_id);
                            $name = $_criteria->name;
                            preg_match('#\((.*?)\)#', $name, $match);
                            if(!Empty($match[1])){
                                preg_match('!\d+!',$match[1], $result);
                                $_sumscore += intVal($result[0]);
                            }else{
                                $_sumscore += 1;
                            }
                        }

                        $checklistgrading = CheckListGrading::where('ev_id',$request->evid)
                                            ->where('pillar_id',$pillar->id)
                                            ->where('sub_pillar_id',$demo->sub_pillar_id)
                                            ->where('sub_pillar_index_id',$demo->sub_pillar_index_id)->first();
                    if(!Empty($checklistgrading)){
                        $yourgrade = 0;

                        if($_sumscore >= $checklistgrading->gradea){
                            $yourgrade = 5;
                        }else if($_sumscore >= $checklistgrading->gradeb && $_sumscore < $checklistgrading->gradea){
                            $yourgrade = 4;
                        }else if($_sumscore >= $checklistgrading->gradec && $_sumscore < $checklistgrading->gradeb){
                            $yourgrade = 3;
                        }else if($_sumscore >= $checklistgrading->graded && $_sumscore < $checklistgrading->gradec){
                            $yourgrade = 2;
                        }else if($_sumscore >= $checklistgrading->gradee && $_sumscore < $checklistgrading->graded){
                            $yourgrade = 1;
                        }

                        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$request->evid)
                                                            ->where('pillar_id',$pillar->id)
                                                            ->where('sub_pillar_id',$demo->sub_pillar_id)
                                                            ->where('sub_pillar_index_id',$demo->sub_pillar_index_id)->first();
                        //    echo ('Pillar Id:' .$pillar->id. ' All: '. count($count)) . ' Select: ' . $inscore->count() . ' Grade: ' . $yourgrade . ' Weight: ' . $pillaindexweigth->weigth . '<br>';   
                        $gradesummary = new GradeSummary();
                        $gradesummary->full_tbp_id = $ev->full_tbp_id;
                        $gradesummary->ev_id = $ev->id;
                        $gradesummary->ev_type_id = $i;
                        $gradesummary->pillar_id = $pillar->id;
                        $gradesummary->grade = $yourgrade;
                        $gradesummary->weight = $pillaindexweigth->weigth;
                        $gradesummary->weightsum = floatval($yourgrade) * floatval($pillaindexweigth->weigth);
                        $gradesummary->save();
                        }
                    }
                }
            }
        }                        
       
        $pillars = Pillar::get();
        $gradesummaryindex = GradeSummary::where('ev_id',$request->evid)->get();
        FinalGrade::where('ev_id',$request->evid)->delete(); 
        foreach ($pillars as $key => $pillar) {
            $check = GradeSummary::where('ev_id',$request->evid)->where('pillar_id',$pillar->id)->get();
            if($check->count() > 0){
                $totalweightsum = GradeSummary::where('ev_id',$request->evid)->where('pillar_id',$pillar->id)->sum('weightsum')/5;
                $totalweight = GradeSummary::where('ev_id',$request->evid)->where('pillar_id',$pillar->id)->sum('weight');              
                $finalgrade =  new FinalGrade();
                $finalgrade->full_tbp_id = $ev->full_tbp_id;
                $finalgrade->ev_id = $ev->id;
                $finalgrade->pillar_id = $pillar->id;
                $finalgrade->percent = $totalweightsum/$totalweight*100;
                $finalgrade->save();
            }
        }

        $finalgrade = FinalGrade::where('ev_id',$request->evid)->get();
        $indexpercent = FinalGrade::where('ev_id',$request->evid)->where('pillar_id','<=',4)->sum('percent')/FinalGrade::where('ev_id',$request->evid)->where('pillar_id','<=',4)->count();
        $extrapercent = 0;
        if($ev->percentextra > 0){
            $extrapercent = FinalGrade::where('ev_id',$request->evid)->where('pillar_id','>',4)->sum('percent')/FinalGrade::where('ev_id',$request->evid)->where('pillar_id','>',4)->count();
        }
        
        $percent = floatval($indexpercent) * floatval($ev->percentindex)/100 + floatval($extrapercent) * floatval($ev->percentextra)/100 ;
        $grade = 0;
        if($percent >= 87){
            $grade = 'AAA';
        }elseif($percent >= 80 && $percent < 87){
            $grade = 'AA';
        }elseif($percent >= 74 && $percent < 80){
            $grade = 'A';
        }elseif($percent >= 70 && $percent < 74){
            $grade = 'BBB';
        }elseif($percent >= 64 && $percent < 70){
            $grade = 'BB';
        }elseif($percent >= 56 && $percent < 64){
            $grade = 'B';
        }elseif($percent >= 54 && $percent < 56){
            $grade = 'CCC';
        }elseif($percent >= 51 && $percent < 54){
            $grade = 'CC';
        }elseif($percent >= 48 && $percent < 51){
            $grade = 'C';
        }else{
            $grade = 'D';
        }

        ProjectGrade::where('ev_id',$request->evid)->delete(); 
        $projectgrade =  new ProjectGrade();
        $projectgrade->full_tbp_id = $ev->full_tbp_id;
        $projectgrade->ev_id = $ev->id;
        $projectgrade->indexpercent = $indexpercent;
        $projectgrade->indexweight = $ev->percentindex;
        $projectgrade->extrapercent = $extrapercent;
        $projectgrade->extraweight = $ev->percentextra;
        $projectgrade->percent = $percent;
        $projectgrade->grade = $grade;
        $projectgrade->save();
        $projectgrade = ProjectGrade::where('ev_id',$ev->id)->first(['percent', 'grade']); 
        // 
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "finalgrade" => $finalgrade,
            "pillars" => $pillars,
            "projectgrade" => $projectgrade,
            "ev" => $ev
        ));
    }

    public function EditScore(Request $request){
        $scoring = Scoring::where('criteria_transaction_id',$request->transactionid)->where('user_id',Auth::user()->id)->first();
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
                $scoring->delete();
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
                if($numcheck >= $grade){
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
        return response()->json($weightsum); 
    }

    public function EditComment(Request $request){
        $scoring = Scoring::where('criteria_transaction_id',$request->transactionid)
                        ->where('user_id',Auth::user()->id)
                        ->whereNotNull('user_id')
                        ->first();
        if(!Empty($scoring)){
            $scoring->update([
                'comment' => $request->comment
            ]);
        }
        $scorings = Scoring::where('criteria_transaction_id',$request->transactionid)
                            ->whereNotNull('user_id')
                            ->get();
        return response()->json($scorings); 
    }

    public function UpdateScoringStatus(Request $request){
        $scoringstatus = ScoringStatus::where('ev_id',$request->evid)
                                    ->where('user_id',Auth::user()->id)
                                    ->first(); 
        if($request->status == 1){
            $scoringstatus = new ScoringStatus();
            $scoringstatus->ev_id = $request->evid;
            $scoringstatus->user_id = Auth::user()->id;
            $scoringstatus->save();
        }else{
            $scoringstatus->delete();
        }     
        $scoringstatus = ScoringStatus::where('ev_id',$request->evid)
                                    ->where('user_id',Auth::user()->id)
                                    ->first();                  
        return response()->json($scoringstatus); 
    }
    
}
