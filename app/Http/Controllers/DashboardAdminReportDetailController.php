<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Bol;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Helper\UserArray;
use App\Model\ProjectLog;
use App\Model\BusinessPlan;
use App\Model\ProjectMember;
use App\Model\ProjectStatus;
use Illuminate\Http\Request;
use App\Model\FullTbpHistory;
use App\Model\TimeLineHistory;
use App\Model\ExpertAssignment;
use App\Helper\OnlyBelongPerson;
use App\Model\ProjectAssignment;
use Illuminate\Support\Facades\Auth;
use App\Model\ProjectStatusTransaction;
use Illuminate\Support\Facades\Session;

class DashboardAdminReportDetailController extends Controller
{
    public function __construct() 
    { 
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:3,4,5,6'); 
    }
    public function View($id){
  
        $auth = Auth::user();
        $check = ProjectMember::where('user_id',$auth->id)->first();
        
        //$company = Company::find($id);
        //$businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $businessplan = BusinessPlan::find($id);
        $company = Company::find($businessplan->company_id);
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $fulltbphistories = FullTbpHistory::where('full_tbp_id',$fulltbp->id)->orderBy('id','desc')->get();
        $projectmembers = ProjectMember::where('full_tbp_id',$fulltbp->id)->get();
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $projectstatuses = ProjectStatus::where('mini_tbp_id',$minitbp->id)->get();
        $projectstatustransactions = ProjectStatusTransaction::where('mini_tbp_id',$minitbp->id)->get();
        $bols = Bol::where('full_tbp_id',$fulltbp->id)->get();
        $timelinehistories = TimeLineHistory::where('business_plan_id',$businessplan->id)->orderBy('id','desc')->paginate(5);
        $projectlogs = ProjectLog::where('mini_tbp_id',$minitbp->id)->whereJsonContains('viewer', $auth->id)->orderBy('id','desc')->paginate(7);

        $company_name = (!Empty($company->name))?$company->name:'';
        $bussinesstype = $company->business_type_id;
        $fullcompanyname = $company_name;

        if($bussinesstype == 1){
            $fullcompanyname = 'บริษัท ' . $company_name . ' จำกัด (มหาชน)';
        }else if($bussinesstype == 2){
            $fullcompanyname = 'บริษัท ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 3){
            $fullcompanyname = 'ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
        }else if($bussinesstype == 4){
            $fullcompanyname = 'ห้างหุ้นส่วนสามัญ ' . $company_name; 
        }

        if(OnlyBelongPerson::LeaderAndExpert($minitbp->id) == false){
            return view('dashboard.admin.report.detail.view')->withCompany($company)
                ->withProjectmembers($projectmembers)
                ->withProjectstatustransactions($projectstatustransactions)
                ->withProjectstatuses($projectstatuses)
                ->withProjectassignment($projectassignment)
                ->withBols($bols)
                ->withFulltbphistories($fulltbphistories)
                ->withTimelinehistories($timelinehistories)
                ->withProjectlogs($projectlogs)
                ->withMinitbp($minitbp)
                ->withBusinessplan($businessplan)
                ->withFulltbp($fulltbp)
                ->withFullcompanyname($fullcompanyname);
        }else{
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
        }

    }

    public function AddExistingDemo(){
        $businessplans = BusinessPlan::get();
        foreach ($businessplans as $key => $businessplan) {
            $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
            $arr1 = UserArray::expert($businessplan->id);
            $arr2 = UserArray::adminandjd($businessplan->id);
            $arr3 = UserArray::leader($businessplan->id);
            $userarray = array_unique(array_merge($arr1,$arr2,$arr3));
            ProjectLog::where('mini_tbp_id',$minitbp->id)->update([
                'viewer' => $userarray
            ]);

            TimeLineHistory::where('mini_tbp_id',$minitbp->id)->update([
                'viewer' => $userarray
            ]);
        }
        return ;
    }
    public function Getarray($id){
//   return UserArray::projectmember($id);

       $minitbp = MiniTBP::where('business_plan_id',$id)->first();
       $projectlog =  TimeLineHistory::where('mini_tbp_id',$minitbp->id)->first();
       foreach ($projectlog->viewer as $key => $viewer) {
           echo($viewer) . '<br>';
       }
       return ;
    }
}
