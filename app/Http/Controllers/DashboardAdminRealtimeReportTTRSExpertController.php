<?php

namespace App\Http\Controllers;
use Excel;
use App\User;
use App\Model\ExpertBranch;
use App\Model\ExpertDetail;
use Illuminate\Http\Request;
use App\Model\EducationLevel;
use App\ExcelFromView\Report\Project\ReportExpertExport;
use App\ExcelFromView\Report\Project\ReportSingleExpertExport;

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

    public function GetExpert(Request $request){
        $expertbranches = ExpertBranch::get();
        $educationlevels = EducationLevel::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportExpertExport($request->search,$request->expertbranch,$request->educationlevel), 'project.xlsx');
        }else if($request->btnsubmit == 'search'){
            if(!Empty($request->search) && $request->expertbranch == 0  && $request->educationlevel == 0){
                $userarray = User::where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
                $expertdetailarr1 = ExpertDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
                $expertdetailarruniques = array_unique($expertdetailarr1);
                $expertdetails = ExpertDetail::whereIn('id',$expertdetailarruniques)->get();
            }elseif (!Empty($request->search) && $request->expertbranch != 0  && $request->educationlevel == 0){
                $userarray = User::where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
                $expertdetailarr1 = ExpertDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
                $expertdetailarruniques = array_unique($expertdetailarr1);
                $expertdetails = ExpertDetail::whereIn('id',$expertdetailarruniques)->where('expert_branch_id',$request->expertbranch)->get();
            }elseif (!Empty($request->search) && $request->expertbranch == 0  && $request->educationlevel != 0){
                $userarray = User::where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
                $expertdetailarr1 = ExpertDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
                $expertdetailarruniques = array_unique($expertdetailarr1);
                $expertdetails = ExpertDetail::whereIn('id',$expertdetailarruniques)->where('education_level_id',$request->educationlevel)->get();
            }elseif (Empty($request->search) && $request->expertbranch != 0  && $request->educationlevel == 0){
                $expertdetails = ExpertDetail::where('expert_branch_id',$request->expertbranch)->get();
            }elseif (Empty($request->search) && $request->expertbranch != 0  && $request->educationlevel != 0){
                $expertdetails = ExpertDetail::where('expert_branch_id',$request->expertbranch)->where('education_level_id',$request->educationlevel)->get();
            }elseif (Empty($request->search) && $request->expertbranch == 0  && $request->educationlevel != 0){
                $expertdetails = ExpertDetail::where('education_level_id',$request->educationlevel)->get();
            }elseif (!Empty($request->search) && $request->expertbranch != 0  && $request->educationlevel != 0){
                $userarray = User::where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
                $expertdetailarr1 = ExpertDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
                $expertdetailarruniques = array_unique($expertdetailarr1);
                $expertdetails = ExpertDetail::whereIn('id',$expertdetailarruniques)->where('expert_branch_id',$request->expertbranch)->where('education_level_id',$request->educationlevel)->get();
            }else{
                $expertdetails = ExpertDetail::get();
            }

            return view('dashboard.admin.realtimereport.expert.index')->withExpertdetails($expertdetails)
                                                                        ->withExpertbranches($expertbranches)
                                                                        ->withEducationlevels($educationlevels);
        }
    }
    public function SingleExpertDownload($id){
        return Excel::download(new ReportSingleExpertExport($id), 'project.xlsx');
    }
}
