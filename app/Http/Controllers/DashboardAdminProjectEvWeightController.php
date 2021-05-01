<?php

namespace App\Http\Controllers;

use App\Model\Ev;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\EvCommentTab;
use App\Model\EvEditHistory;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Model\PillaIndexWeigth;
use App\Helper\OnlyBelongPerson;
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Model\CriteriaTransaction;
use Illuminate\Support\Facades\Auth;
use App\Model\ExtraCriteriaTransaction;
use Illuminate\Support\Facades\Session;

class DashboardAdminProjectEvWeightController extends Controller
{
    public function Index(){
        $auth = Auth::user();
       if($auth->user_type_id != 5){
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
       }
       
        NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',6)
                        ->where('status',0)->delete();

        $fulltbps = collect();
        if($auth->user_type_id < 5){
            $fulltbpids = ProjectMember::where('user_id',$auth->id)->pluck('full_tbp_id')->toArray();
            $_fulltbpids = Ev::whereIn('full_tbp_id',$fulltbpids)->where('status','>=',2)->pluck('full_tbp_id')->toArray();
            $fulltbps = FullTbp::whereIn('id',$_fulltbpids)->get();
        }else{
            $fulltbps = FullTbp::where('status',1)->get();
        }
     
        return view('dashboard.admin.project.evweight.index')->withFulltbps($fulltbps) ;
    }

    public function Edit($id){

        $auth = Auth::user();
        NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',6)
                        ->where('status',0)->delete();
        $evedithistories = EvEditHistory::where('ev_id',$id)->where('historytype',2)->get();
        $evcommenttabs = EvCommentTab::where('ev_id',$id)->where('stage',2)->get();
        $ev = Ev::find($id);
        $fulltbp = FullTbp::find($ev->full_tbp_id);
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        if(OnlyBelongPerson::Admin($minitbp->id) == false){
            return view('dashboard.admin.project.evweight.edit')->withEv($ev)
                    ->withEvedithistories($evedithistories)
                    ->withEvcommenttabs($evcommenttabs);
        }else{
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
        }

    }

    public function GetEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get()
                                                ->makeHidden(['updated_at','created_at','index_type_id'])
                                                ->makeHidden('scoring');
        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$request->evid)->get()->makeHidden(['updated_at','created_at']);
        $sumweigth = round(PillaIndexWeigth::where('ev_id',$request->evid)->where('ev_type_id',1)->sum('weigth'), 4); 
        $sumextraweigth = round(ExtraCriteriaTransaction::where('ev_id',$request->evid)->sum('weight'), 4); 
        
        $extracriteriatransactions = ExtraCriteriaTransaction::where('ev_id',$request->evid)
                                                        ->orderBy('extra_category_id', 'asc')
                                                        ->orderBy('extra_criteria_id', 'asc')
                                                        ->get()
                                                        ->append('extracategory')
                                                        ->append('extracriteria');   
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "pillaindexweigths" => $pillaindexweigths,
            "sumweigth" => $sumweigth,
            "sumextraweigth" => $sumextraweigth,
            "extracriteriatransactions" => $extracriteriatransactions
        ));
    }

    public function EditSave(Request $request){
        PillaIndexWeigth::find($request->id)->update([
            'weigth' => $request->value
        ]);
        $pillaindexweigth = PillaIndexWeigth::find($request->id);
        $sumweigth = PillaIndexWeigth::where('ev_id',$pillaindexweigth->ev_id)->where('ev_type_id',$request->evtypeid)->sum('weigth'); 
        return response()->json(array(
            "pillaindexweigth" => $pillaindexweigth,
            "sumweigth" => $sumweigth
        ));
    }
}
