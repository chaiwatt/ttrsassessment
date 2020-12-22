<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\ExpertBranch;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;

class DashboardAdminSearchOfficerController extends Controller
{
    public function Index(){
        $officerdetailids = OfficerDetail::pluck('user_id')->toArray();
        $officers = User::whereIn('id',$officerdetailids)->get();
        $expertbranches = ExpertBranch::get();
        return view('dashboard.admin.search.officer.index')->withOfficers($officers)
                                                        ->withExpertbranches($expertbranches);
    }
}
