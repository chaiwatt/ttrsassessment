<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\GeneralInfo;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\CalendarType;
use App\Model\PopupMessage;
use App\Model\ProjectGrade;
use App\Model\EventCalendar;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;

class DashboardAdminReportController extends Controller
{
    public function __construct() 
    { 
        $this->middleware(['auth', 'verified']);
        // $this->middleware('role:0,4,5,6'); 
    }
    public function Index(){
        $check = GeneralInfo::first()->show_finished_project_id;
        $auth = Auth::user();
        $businessplanarr = BusinessPlan::where('business_plan_status_id','>',2)->pluck('id')->toArray();
        $minitbparr = MiniTBP::whereIn('business_plan_id',$businessplanarr)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id',$minitbparr)->get();
        if($auth->user_type_id == 4){
            $businessplanids = ProjectAssignment::where('leader_id',$auth->id)
                                            ->orWhere('coleader_id',$auth->id)
                                            ->pluck('business_plan_id')->toArray();                               
            $minitbpids = MiniTBP::whereIn('business_plan_id',$businessplanids)->pluck('id')->toArray();
            $fulltbparr = FullTbp::whereIn('mini_tbp_id', $minitbpids)->pluck('id')->toArray();

            $expertarr = ExpertAssignment::where('user_id',$auth->id)->where('expert_assignment_status_id',2)->pluck('full_tbp_id')->toArray();
            $uniquefulltbparr = array_unique(array_merge($expertarr,$fulltbparr));
            $fulltbps = FullTbp::whereIn('id',$uniquefulltbparr)->get();
            // $fulltbparray = FullTbp::whereIn('id',$uniquefulltbparr)->pluck('id')->toArray();

        }
        $userarr = User::where('user_type_id',1)->pluck('id')->toArray();
        $totalcompany = Company::whereIn('user_id',$userarr)->count();
        $businessplans = BusinessPlan::get();
        $totalproject = MiniTBP::whereNotNull('submitdate')->count();
        $totalminitbp = MiniTBP::whereNotNull('submitdate')->count();
        $totalfulltbp = FullTbp::whereNotNull('submitdate')->count();
        $minitbparr = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
        $totalonprocess = FullTbp::whereIn('mini_tbp_id',$minitbparr)->whereNull('finishdate')->count();
        $totalfinish = FullTbp::whereIn('mini_tbp_id',$minitbparr)->whereNotNull('finishdate')->count();

     
        $alertmessages = AlertMessage::where('target_user_id',$auth->id)->get();
        $eventcalendarattendees = EventCalendarAttendee::where('user_id',$auth->id)->get();

        $numprojects = Array();
        $projectgrades = Array();
        $projectindustrys = Array();
        $objectives = Array();
        $years = BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray();
        foreach ($years as $key => $year) {

             $projecteachyear = Array();
             $projectgrade = Array();
             $projectindustry = Array();
             $objective = Array();
             
             $minitpbcounts = BusinessPlan::where('business_plan_status_id','>=',4)->whereYear('created_at', $year)->count();
             $fulltbpcounts = BusinessPlan::where('business_plan_status_id','>=',6)->whereYear('created_at', $year)->count();
             $finishecountd = BusinessPlan::where('business_plan_status_id','>=',8)->whereYear('created_at', $year)->count();

             if($minitpbcounts != 0 || $fulltbpcounts != 0 || $finishecountd != 0 ){
                $projecteachyear = array("year" => $year+543,"minitpbs" => $minitpbcounts, "fulltbps" => $fulltbpcounts,"finished" => $finishecountd);
                array_push($numprojects,$projecteachyear);
             }

             $aaa = ProjectGrade::where('grade','AAA')->whereYear('created_at', $year)->count();
             $aa = ProjectGrade::where('grade','AA')->whereYear('created_at', $year)->count();
             $a = ProjectGrade::where('grade','A')->whereYear('created_at', $year)->count();
             $bbb = ProjectGrade::where('grade','BBB')->whereYear('created_at', $year)->count();
             $bb = ProjectGrade::where('grade','BB')->whereYear('created_at', $year)->count();
             $b = ProjectGrade::where('grade','B')->whereYear('created_at', $year)->count();
             $ccc = ProjectGrade::where('grade','CCC')->whereYear('created_at', $year)->count();
             $cc = ProjectGrade::where('grade','CC')->whereYear('created_at', $year)->count();
             $c = ProjectGrade::where('grade','C')->whereYear('created_at', $year)->count();     
             $d = ProjectGrade::where('grade','D')->whereYear('created_at', $year)->count();

             if($aaa != 0 || $aa != 0 || $a != 0 || $bbb != 0 || $bb != 0 || $b != 0 || $ccc != 0 || $cc != 0 || $c != 0 || $d != 0){
                $projectgrade = array("year" => $year+543,"AAA" => $aaa, "AA" => $aa,"A" => $a,"BBB" => $bbb, "BB" => $bb,"B" => $b,"CCC" => $ccc, "CC" => $cc,"C" => $c,"D" => $d);
                array_push($projectgrades,$projectgrade);
             }

             $businessplans = BusinessPlan::where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->get();
             $automotivearr = Company::where('industry_group_id',1)->pluck('id')->toArray();
             $automotive = BusinessPlan::whereIn('company_id',$automotivearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $smartelectronicarr = Company::where('industry_group_id',2)->pluck('id')->toArray();
             $smartelectronic = BusinessPlan::whereIn('company_id',$smartelectronicarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $affluentarr = Company::where('industry_group_id',3)->pluck('id')->toArray();
             $affluent = BusinessPlan::whereIn('company_id',$affluentarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $agriculturearr = Company::where('industry_group_id',4)->pluck('id')->toArray();
             $agriculture = BusinessPlan::whereIn('company_id',$agriculturearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $foodarr = Company::where('industry_group_id',5)->pluck('id')->toArray();
             $food = BusinessPlan::whereIn('company_id',$foodarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $roboticarr = Company::where('industry_group_id',6)->pluck('id')->toArray();
             $robotic = BusinessPlan::whereIn('company_id',$roboticarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $aviationarr = Company::where('industry_group_id',7)->pluck('id')->toArray();
             $aviation = BusinessPlan::whereIn('company_id',$aviationarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $biofuelarr = Company::where('industry_group_id',8)->pluck('id')->toArray();
             $biofuel = BusinessPlan::whereIn('company_id',$biofuelarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $digitalarr = Company::where('industry_group_id',9)->pluck('id')->toArray();
             $digital = BusinessPlan::whereIn('company_id',$digitalarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $medicalarr = Company::where('industry_group_id',10)->pluck('id')->toArray();
             $medical = BusinessPlan::whereIn('company_id',$medicalarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $defensearr = Company::where('industry_group_id',11)->pluck('id')->toArray();
             $defense = BusinessPlan::whereIn('company_id',$defensearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $educationarr = Company::where('industry_group_id',12)->pluck('id')->toArray();
             $education = BusinessPlan::whereIn('company_id',$educationarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
             $otherarr = Company::where('industry_group_id',13)->pluck('id')->toArray();
             $other = BusinessPlan::whereIn('company_id',$otherarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();

             if($automotive != 0 || $smartelectronic != 0 || $affluent != 0 || $agriculture != 0 || $food != 0 || $robotic != 0 || $aviation != 0 || $biofuel != 0 || $digital != 0 || $medical != 0 || $defense != 0 || $education != 0 || $other != 0){
                $projectindustry = array("year" => $year+543,"automotive" => $automotive, "smartelectronic" => $smartelectronic,"affluent" => $affluent,"agriculture" => $agriculture, "food" => $food,"robotic" => $robotic,"aviation" => $aviation, "biofuel" => $biofuel,"digital" => $digital,"medical" => $medical,"defense" => $defense,"education" => $education,"other" => $other);
                array_push($projectindustrys,$projectindustry);
             }

             $financeojective = MiniTBP::where('minitbp_objecttive',1)->whereYear('created_at', $year)->count();
             $nonefinanceojective = MiniTBP::where('minitbp_objecttive',2)->whereYear('created_at', $year)->count();
             $bothojective = MiniTBP::where('minitbp_objecttive',3)->whereYear('created_at', $year)->count();

             if($financeojective != 0 || $nonefinanceojective != 0 || $bothojective != 0 ){
                $objective = array("year" => $year+543,"finance" => $financeojective, "nonfinance" => $nonefinanceojective,"bothobjecttive" => $bothojective);
                array_push($objectives,$objective);
             }
        }

        $numprojectcollections = collect($numprojects);
        $projectgradecollections = collect($projectgrades);
        $projectindustrycollections = collect($projectindustrys);
        $objecttivecollections = collect($objectives);


        $fulltbparr = FullTbp::pluck('id')->toArray();
        $projectassignments =  ProjectAssignment::whereIn('full_tbp_id',$fulltbparr)->get();
        $leaderarr = [];
        foreach($projectassignments as $projectassignment){
            if(!Empty($projectassignment->leader_id)){
               array_push($leaderarr,$projectassignment->leader_id)  ;
            }
        }
        if(count($leaderarr) > 0){
            $leaderarr =array_unique($leaderarr);
        }
       
        $leaders = User::whereIn('id',$leaderarr)->get();


        $expertassignments =  ExpertAssignment::whereIn('full_tbp_id',$fulltbparr)->get();
 
        $expertarr = [];
        foreach($expertassignments as $expertassignment){
            array_push($expertarr,$expertassignment->user_id)  ;
        }

        if(count($expertarr) > 0){
            $expertarr =array_unique($expertarr);
        }
       
        $experts = User::whereIn('id',$expertarr)->get();
     
        $gradearr = [];
        $gradearr =  ProjectGrade::pluck('grade')->toArray();
        if(count($gradearr) > 0){
            $gradearr =array_unique($gradearr);
        }

        $gradecollection = collect($gradearr);
        $popupmessages = PopupMessage::get();
        return view('dashboard.admin.report.index')->withEventcalendarattendees($eventcalendarattendees)
                                                ->withFulltbps($fulltbps)
                                                ->withAlertmessages($alertmessages)
                                                ->withBusinessplans($businessplans)
                                                ->withNumprojectcollections($numprojectcollections)
                                                ->withProjectgradecollections($projectgradecollections)
                                                ->withProjectindustrycollections($projectindustrycollections)
                                                ->withObjecttivecollections($objecttivecollections)
                                                ->withTotalproject($totalproject)
                                                ->withTotalcompany($totalcompany)
                                                ->withTotalminitbp($totalminitbp)
                                                ->withTotalfulltbp($totalfulltbp)
                                                ->withTotalonprocess($totalonprocess)
                                                ->withTotalfinish($totalfinish)
                                                ->withLeaders($leaders)
                                                ->withExperts($experts)
                                                ->withGradecollection($gradecollection)
                                                ->withPopupmessages($popupmessages);



    }
    public function GetEvent(Request $request){
        $auth = Auth::user();
        $eventcalendarattendees = EventCalendarAttendee::where('user_id',$auth->id)->where('joinevent','!=',3)->pluck('event_calendar_id')->toArray();
        $eventcalendars = EventCalendar::whereNotNull('subject')
                                    ->whereNotNull('eventdate')
                                    ->whereNotNull('starttime')
                                    ->whereNotNull('endtime')
                                    ->whereNotNull('place')
                                    ->whereNotNull('summary')
                                    ->whereIn('id',$eventcalendarattendees)->get();                         
        $_events = array();

        foreach ($eventcalendars as $event) {
            $eventcalendarattendee = EventCalendarAttendee::where('user_id',$auth->id)->where('event_calendar_id',$event->id)->first();
            $eventcalendar = EventCalendar::find($event->id);
            $calendartype = CalendarType::find($eventcalendar->calendar_type_id);
            $fulltbp = FullTbp::find($eventcalendar->full_tbp_id);
            $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
            $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            $company = Company::find($businessplan->company_id);
    
            $company_name = (!Empty($company->name))?$company->name:'';
            $bussinesstype = $company->business_type_id;
            $fullcompanyname = ' ' . $company_name;
    
            if($bussinesstype == 1){
                $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด (มหาชน)';
            }else if($bussinesstype == 2){
                $fullcompanyname = ' บริษัท ' . $company_name . ' จำกัด'; 
            }else if($bussinesstype == 3){
                $fullcompanyname = ' ห้างหุ้นส่วน ' . $company_name . ' จำกัด'; 
            }else if($bussinesstype == 4){
                $fullcompanyname = ' ห้างหุ้นส่วนสามัญ ' . $company_name; 
            }
            $_events[] = array('id' => $event->id,'color' => $eventcalendarattendee->color,'start' => $event->eventdate, 'summary' => $calendartype->name . ' ' . $fullcompanyname);
        }
        return collect($_events);
    }
}
