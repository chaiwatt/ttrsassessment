<?php

namespace App\Http\Controllers;

use App\Model\Ev;
use App\Model\Grade;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use Illuminate\Http\Request;
use App\Model\PillaIndexWeigth;
use App\Model\ProjectAssignment;
use App\Model\CriteriaTransaction;
use Illuminate\Support\Facades\Auth;

class DashboardAdminProjectEvWeightController extends Controller
{
    public function Index(){
        $auth = Auth::user();
        $fulltbps = FullTbp::where('status',2)->get();
        if($auth->user_type_id < 6){
            $businessplanids = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->pluck('business_plan_id')->toArray();
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fullpbts = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        }
        return view('dashboard.admin.project.evweight.index')->withFulltbps($fulltbps) ;
    }

    public function Edit($id){
        $fulltbp = FullTbp::find($id);
        $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
        return view('dashboard.admin.project.evweight.edit')->withEv($ev);
    }

    public function GetEv(Request $request){
        $criteriatransactions = CriteriaTransaction::where('ev_id',$request->evid)
                                                ->orderBy('pillar_id','asc')
                                                ->orderBy('sub_pillar_id', 'asc')
                                                ->orderBy('sub_pillar_index_id', 'asc')
                                                ->get();
        $pillaindexweigths = PillaIndexWeigth::where('ev_id',$request->evid)->get();
        $sumweigth = round(PillaIndexWeigth::where('ev_id',$request->evid)->sum('weigth'), 4); 
        return response()->json(array(
            "criteriatransactions" => $criteriatransactions,
            "pillaindexweigths" => $pillaindexweigths,
            "sumweigth" => $sumweigth
        ));

    }

    public function EditSave(Request $request){
        PillaIndexWeigth::find($request->id)->update([
            'weigth' => $request->value
        ]);
        $pillaindexweigth = PillaIndexWeigth::find($request->id);
        $sumweigth = PillaIndexWeigth::where('ev_id',$pillaindexweigth->ev_id)->sum('weigth'); 
        return response()->json(array(
            "pillaindexweigth" => $pillaindexweigth,
            "sumweigth" => $sumweigth
        ));
    }
}
