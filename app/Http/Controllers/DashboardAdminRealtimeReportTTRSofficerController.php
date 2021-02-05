<?php

namespace App\Http\Controllers;
use Excel;
use App\User;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;
use App\ExcelFromView\Report\Project\ReportTTRSOfficerExport;
use App\ExcelFromView\Report\Project\ReportTTRSSingleOfficerExport;

class DashboardAdminRealtimeReportTTRSofficerController extends Controller
{
    public function Index(){
        $officers = OfficerDetail::get();
        return view('dashboard.admin.realtimereport.ttrsofficer.index')->withOfficers($officers); 
    }

    public function GetOfficer(Request $request){
        if($request->btnsubmit == 'excel'){
            return Excel::download(new ReportTTRSOfficerExport($request->search), 'project.xlsx');

        }else if($request->btnsubmit == 'search'){
            
            $userarray = User::where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('lastname', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
            
            $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            
            $officerdetailarr2 = OfficerDetail::where('position', 'like', '%' . $request->search . '%')
                            ->orWhere('organization', 'like', '%' . $request->search . '%')->pluck('id')->toArray();
           
            $officerdetailarruniques = array_unique(array_merge($officerdetailarr1,$officerdetailarr2));
            $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->get();
            return view('dashboard.admin.realtimereport.ttrsofficer.index')->withOfficers($officers);  
        }
    }
    public function SingleDownload($id){
        return Excel::download(new ReportTTRSSingleOfficerExport($id), 'project.xlsx');
    }

}
