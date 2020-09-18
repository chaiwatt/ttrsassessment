<?php

namespace App\Http\Controllers;

use App\Model\Ev;
use App\Model\EvType;
use App\Model\Pillar;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Scoring;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Model\CheckListGrading;
use App\Model\PillaIndexWeigth;
use App\Model\ProjectAssignment;
use App\Model\CriteriaTransaction;
use Illuminate\Support\Facades\Auth;

class DashboardAdminAssessmentController extends Controller
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
                                ->pluck('sub_pillar_index_id')
                                ->toArray();
    $basearray = array();                            
    foreach ($subpillarindexarray as $key => $subpillarindex) {
        $scores = Scoring::where('sub_pillar_index_id',$subpillarindex)
                    ->pluck('criteria_transaction_id')
                    ->toArray();         
        $basearray = array_merge(array_keys(array_intersect(array_count_values($scores),[1])),$basearray);// array_merge(array_keys(array_intersect(array_count_values($basearray),[1])),$scores);   
    }
    $subpillarindexarray = Scoring::where('ev_id',$request->evid)
                    ->distinct('sub_pillar_index_id')
                    ->where('scoretype',1)
                    ->pluck('sub_pillar_index_id')
                    ->toArray();
    foreach ($subpillarindexarray as $key => $subpillarindex) {
        $scores = Scoring::where('sub_pillar_index_id',$subpillarindex)
                    ->pluck('score')
                    ->toArray();   
            if(count(array_unique($scores)) != 1){
                $basearray[] = Scoring::where('ev_id',$request->evid)->where('sub_pillar_index_id',$subpillarindex)->first()->criteria_transaction_id;
            }   
    }
    $criteriatransactions = CriteriaTransaction::whereIn('id',$basearray)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();

        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$request->evid)->get();
        $sumweigth = round(PillaIndexWeigth::where('ev_id',$request->evid)->sum('weigth'), 4); 
        $pillars = Pillar::get();   
        $evportions = EvType::get();   
    
        $scores = Scoring::where('ev_id',$request->evid)
                    ->where('scoretype',2)
                    ->get();
        $checklistgradings = CheckListGrading::where('ev_id',$request->evid)->get(); 
        $fulltbp = FullTbp::find(Ev::find($request->evid)->full_tbp_id);
        $projectmembers = ProjectMember::where('full_tbp_id',$fulltbp->id)->get(); 
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "pillaindexweigths" => $pillaindexweigths,
            "sumweigth" => $sumweigth,
            "pillars" => $pillars,
            "evportions" => $evportions,
            "scores" => $scores,
            "checklistgradings" => $checklistgradings,
            "projectmembers" => $projectmembers
        ));
    }

    public function AddScore(Request $request){
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
            $grades=array($checklistgrading->gradea,$checklistgrading->gradeb,$checklistgrading->gradec,$checklistgrading->graded,$checklistgrading->gradee,$checklistgrading->gradef);    
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
        // return response()->json($weightsum); 
        $subpillarindexarray = Scoring::where('ev_id',$criteriatransaction->ev_id)
                ->distinct('sub_pillar_index_id')
                ->where('scoretype',2)
                ->pluck('sub_pillar_index_id')
                ->toArray();
        $basearray = array();                            
        foreach ($subpillarindexarray as $key => $subpillarindex) {
            $scores = Scoring::where('sub_pillar_index_id',$subpillarindex)
            ->pluck('criteria_transaction_id')
            ->toArray();         
            $basearray = array_merge(array_keys(array_intersect(array_count_values($scores),[1])),$basearray);// array_merge(array_keys(array_intersect(array_count_values($basearray),[1])),$scores);   
        }
        $subpillarindexarray = Scoring::where('ev_id',$criteriatransaction->ev_id)
                                    ->distinct('sub_pillar_index_id')
                                    ->where('scoretype',1)
                                    ->pluck('sub_pillar_index_id')
                                    ->toArray();
        foreach ($subpillarindexarray as $key => $subpillarindex) {
        $scores = Scoring::where('sub_pillar_index_id',$subpillarindex)
                        ->pluck('score')
                        ->toArray();   
        if(count(array_unique($scores)) != 1){
            $basearray[] = Scoring::where('ev_id',$criteriatransaction->ev_id)->where('sub_pillar_index_id',$subpillarindex)->first()->criteria_transaction_id;
        }   
        }
        $criteriatransactions = CriteriaTransaction::whereIn('id',$basearray)
                                ->orderBy('pillar_id','asc')
                                ->orderBy('sub_pillar_id', 'asc')
                                ->orderBy('sub_pillar_index_id', 'asc')
                                ->get();

        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$criteriatransaction->ev_id)->get();
        $sumweigth = round(PillaIndexWeigth::where('ev_id',$criteriatransaction->ev_id)->sum('weigth'), 4); 
        $pillars = Pillar::get();   
        $evportions = EvType::get();   

        $scores = Scoring::where('ev_id',$criteriatransaction->ev_id)
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
                        ->where('scoretype',2)
                        ->where('criteria_transaction_id',$request->id)
                        ->get();
        return response()->json($scores); 
    }

    
    public function ConflictGrade(Request $request){
        $criteriatransaction = CriteriaTransaction::find($request->id);
        $scores = Scoring::where('ev_id',$criteriatransaction->ev_id)
                        ->where('scoretype',1)
                        ->where('sub_pillar_index_id',$criteriatransaction->sub_pillar_index_id)
                        ->get();
        return response()->json($scores); 
    }
}
