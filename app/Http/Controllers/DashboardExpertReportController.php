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
        $fulltbptids = ExpertAssignment::whereIn('user_id', $userids)->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id', $fulltbptids)->get();
        return view('dashboard.expert.report.index')->withFulltbps($fulltbps);
    }
}
