<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\ExpertBranch;
use App\Model\ExpertDetail;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;

class DashboardAdminSearchExpertController extends Controller
{
    public function Index(){
        $expertdetailids = ExpertDetail::pluck('user_id')->toArray();
        $experts = User::whereIn('id',$expertdetailids)->get();
        $expertbranches = ExpertBranch::get();
        $minitbps = MiniTBP::get();
        return view('dashboard.admin.search.expert.index')->withExperts($experts)
                                                        ->withExpertbranches($expertbranches)
                                                        ->withMinitbps($minitbps);
    }

}
