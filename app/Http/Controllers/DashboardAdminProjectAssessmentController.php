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
use App\Helper\EmailBox;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\ProjectScoring;
use App\Model\PillaIndexWeigth;
use App\Model\ProjectAssignment;
use App\Model\CriteriaTransaction;
use Illuminate\Support\Facades\Auth;
use App\Model\CriteriaGroupTransaction;

class DashboardAdminProjectAssessmentController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        $fulltbps = FullTbp::where('status',2)->get();
        if($auth->user_type_id < 7){
            $businessplanids = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->pluck('business_plan_id')->toArray();
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        }
        return view('dashboard.admin.project.assessment.index')->withFulltbps($fulltbps);
    }
    public function Edit($id){
        $fulltbp = FullTbp::find($id);
        $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
        return view('dashboard.admin.project.assessment.edit')->withEv($ev);
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
        $users = User::where('user_type_id','>=',7)->pluck('id')->toArray();
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
        '<br><br>ด้วยความนับถือ<br>TTRS');
        return redirect()->route('dashboard.admin.project.assessment')->withSuccess('ลงคะแนนสำเร็จ');
    }

    public function GetEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$request->evid)->get();
        $sumweigth = round(PillaIndexWeigth::where('ev_id',$request->evid)->sum('weigth'), 4); 
        $pillars = Pillar::get();   
        $evportions = EvType::get();   
       
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "pillaindexweigths" => $pillaindexweigths,
            "sumweigth" => $sumweigth,
            "pillars" => $pillars,
            "evportions" => $evportions
        ));

    }

    public function EditScore(Request $request){
        $scoring = Scoring::where('criteria_transaction_id',$request->transactionid)->first();
        $criteriatransaction = CriteriaTransaction::find($request->transactionid);
        $pillaindexweigth = PillaIndexWeigth::where('ev_id',$criteriatransaction->ev_id)
                                        ->where('sub_pillar_index_id',$criteriatransaction->sub_pillar_index_id)
                                        ->first();
        $pillar = Pillar::find($criteriatransaction->pillar_id);   
        $evportion = EvType::find(1);                          
        $weightsum = 0;
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
        }else if(strtoupper(trim($request->score)) == '1'){
            $scores = Scoring::where('ev_id',$criteriatransaction->ev_id)
                            ->where('sub_pillar_index_id',$criteriatransaction->sub_pillar_index_id)
                            ->get()->count();
        }

        if(Empty($scoring)){
            $scoring = new Scoring();
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

        $pillars = Pillar::get();   
        $evportions = EvType::get();   
        return response()->json($weightsum); 
    }

    public function EditComment(Request $request){
        $scoring = Scoring::where('criteria_transaction_id',$request->transactionid)->first();
        if(!Empty($scoring)){
            $scoring->update([
                'comment' => $request->comment
            ]);
        }
        $scorings = Scoring::where('criteria_transaction_id',$request->transactionid)->get();
        return response()->json($scorings); 
    }
    
}
