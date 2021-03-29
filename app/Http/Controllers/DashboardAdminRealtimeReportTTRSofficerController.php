<?php

namespace App\Http\Controllers;
use Excel;
use App\User;
use App\Model\ExpertBranch;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;
use App\Model\EducationLevel;
use App\ExcelFromView\Report\Project\ReportTTRSOfficerExport;
use App\ExcelFromView\Report\Project\ReportTTRSSingleOfficerExport;

class DashboardAdminRealtimeReportTTRSofficerController extends Controller
{
    public function Index(){
        $officers = OfficerDetail::get();
        $expertbranches = ExpertBranch::get();
        $educationlevels = EducationLevel::get();
        return view('dashboard.admin.realtimereport.ttrsofficer.index')->withOfficers($officers)
                                                                    ->withExpertbranches($expertbranches)
                                                                    ->withEducationlevels($educationlevels);
    }

    public function GetOfficer(Request $request){
        $expertbranches = ExpertBranch::get();
        $educationlevels = EducationLevel::get();
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportTTRSOfficerExport($request->search,$request->expertbranch,$request->educationlevel), 'project.xlsx');
        }else if($request->btnsubmit == 'search'){
            if(!Empty($request->search) && $request->expertbranch == 0  && $request->educationlevel == 0){
                $userarray = User::where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
                $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
                $officerdetailarruniques = array_unique($officerdetailarr1);
                $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->get();
            }elseif (!Empty($request->search) && $request->expertbranch != 0  && $request->educationlevel == 0){
                $userarray = User::where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
                $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
                $officerdetailarruniques = array_unique($officerdetailarr1);
                $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->where('officer_branch_id',$request->expertbranch)->get();
            }elseif (!Empty($request->search) && $request->expertbranch == 0  && $request->educationlevel != 0){
                $userarray = User::where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
                $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
                $officerdetailarruniques = array_unique($officerdetailarr1);
                $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->where('education_level_id',$request->educationlevel)->get();
            }elseif (Empty($request->search) && $request->expertbranch != 0  && $request->educationlevel == 0){
                $officers = OfficerDetail::where('officer_branch_id',$request->expertbranch)->get();
            }elseif (Empty($request->search) && $request->expertbranch != 0  && $request->educationlevel != 0){
                $officers = OfficerDetail::where('officer_branch_id',$request->expertbranch)->where('education_level_id',$request->educationlevel)->get();
            }elseif (Empty($request->search) && $request->expertbranch == 0  && $request->educationlevel != 0){
                $officers = OfficerDetail::where('education_level_id',$request->educationlevel)->get();
            }elseif (!Empty($request->search) && $request->expertbranch != 0  && $request->educationlevel != 0){
                $userarray = User::where('name', 'like', '%' . $request->search . '%')
                                ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
                $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
                $officerdetailarruniques = array_unique($officerdetailarr1);
                $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->where('officer_branch_id',$request->expertbranch)->where('education_level_id',$request->educationlevel)->get();
            }else{
                $officers = OfficerDetail::get();
            }
            return view('dashboard.admin.realtimereport.ttrsofficer.index')->withOfficers($officers)
                                                                        ->withExpertbranches($expertbranches)
                                                                        ->withEducationlevels($educationlevels);
        }
    }
    public function SingleDownload($id){
        return Excel::download(new ReportTTRSSingleOfficerExport($id), 'project.xlsx');
    }
    

}
