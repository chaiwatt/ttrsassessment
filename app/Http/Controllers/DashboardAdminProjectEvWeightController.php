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
use App\Model\ProjectAssignment;
use App\Model\NotificationBubble;
use App\Model\CriteriaTransaction;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectEvWeightController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        NotificationBubble::where('target_user_id',$auth->id)
                        ->where('notification_category_id',1)
                        ->where('notification_sub_category_id',6)
                        ->where('status',0)->delete();

        $fulltbps = collect();
        if($auth->user_type_id < 6){
            $fulltbpids = ProjectMember::where('user_id',$auth->id)->pluck('full_tbp_id')->toArray();
            $_fulltbpids = Ev::whereIn('full_tbp_id',$fulltbpids)->where('status','>=',2)->pluck('full_tbp_id')->toArray();
            $fulltbps = FullTbp::whereIn('id',$_fulltbpids)->get();
        }else{
            $fulltbps = FullTbp::where('status',1)->get();
        }
        return view('dashboard.admin.project.evweight.index')->withFulltbps($fulltbps) ;
    }

    public function Edit($id){
        $evedithistories = EvEditHistory::where('ev_id',$id)->where('historytype',2)->get();
        $evcommenttabs = EvCommentTab::where('ev_id',$id)->where('stage',2)->get();
        $ev = Ev::find($id);
        return view('dashboard.admin.project.evweight.edit')->withEv($ev)
                                                            ->withEvedithistories($evedithistories)
                                                            ->withEvcommenttabs($evcommenttabs);
    }

    public function GetEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$request->evid)->get();
        $sumweigth = round(PillaIndexWeigth::where('ev_id',$request->evid)->where('ev_type_id',1)->sum('weigth'), 4); 
        $sumextraweigth = round(PillaIndexWeigth::where('ev_id',$request->evid)->where('ev_type_id',2)->sum('weigth'), 4); 
        $ev= Ev::find($request->evid);
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "pillaindexweigths" => $pillaindexweigths,
            "sumweigth" => $sumweigth,
            "sumextraweigth" => $sumextraweigth,
            "ev" => $ev
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
