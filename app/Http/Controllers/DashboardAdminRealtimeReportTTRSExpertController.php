<?php

namespace App\Http\Controllers;

use App\Model\ExpertBranch;
use App\Model\ExpertDetail;
use Illuminate\Http\Request;
use App\Model\EducationLevel;

class DashboardAdminRealtimeReportTTRSExpertController extends Controller
{
    public function Index(){
        $expertdetails = ExpertDetail::get();
        $expertbranches = ExpertBranch::get();
        $educationlevels = EducationLevel::get();
        return view('dashboard.admin.realtimereport.expert.index')->withExpertdetails($expertdetails)
                                                                    ->withExpertbranches($expertbranches)
                                                                    ->withEducationlevels($educationlevels);
    }
}
