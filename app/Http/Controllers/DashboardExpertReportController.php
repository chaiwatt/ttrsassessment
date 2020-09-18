<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\FullTbp;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardExpertReportController extends Controller
{
    public function Index(){
        $userids = User::find(Auth::user()->id)->pluck('id')->toArray();
        $fulltbptids = ExpertAssignment::whereIn('user_id', $userids)
                                    ->where('expert_assignment_status_id',2)
                                    ->pluck('full_tbp_id')
                                    ->toArray();
        $fulltbps = FullTbp::whereIn('id', $fulltbptids)->get();
        return view('dashboard.expert.report.index')->withFulltbps($fulltbps);
    }
    public function Accept($id){
       ExpertAssignment::where('full_tbp_id', $id)
                    ->where('user_id',Auth::user()->id)
                    ->first()
                    ->update([
                        'accepted' => '1'
                    ]);
        $fulltbps = FullTbp::where('id', $id)->get();
        return redirect()->route('dashboard.expert.report')->withSuccess('คุณเข้าร่วมโครงการแล้ว');
    }
    public function Reject($id){
        ExpertAssignment::where('full_tbp_id', $id)
                     ->where('user_id',Auth::user()->id)
                     ->first()
                     ->update([
                         'accepted' => '2'
                     ]);
         $fulltbps = FullTbp::where('id', $id)->get();
         return redirect()->route('dashboard.expert.report')->withSuccess('คุณปฎิเสธเข้าร่วมโครงการแล้ว');
     }
}
