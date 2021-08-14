<?php

namespace App\Http\Controllers;

use App\Model\Ev;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\FinalGrade;
use App\Model\AlertMessage;
use App\Model\BusinessPlan;
use App\Model\EventCalendar;
use Illuminate\Http\Request;
use App\Model\TimeLineHistory;
use App\Model\EventCalendarAttendee;
use Illuminate\Support\Facades\Auth;

class DashboardCompanyReportController extends Controller
{
    public function __construct() 
    { 
        $this->middleware(['auth', 'verified']);
        // $this->middleware('role:4,5,6'); 
    }
    public function Index(){
        $auth = Auth::user();
        $alertmessages = AlertMessage::where('target_user_id',$auth->id)->get();
        $businessplans = BusinessPlan::where('company_id',Company::where('user_id',$auth->id)->first()->id)->get();
        
        $timelinehistories = TimeLineHistory::where('owner_id',$auth->id)->whereJsonContains('viewer', $auth->id)->orderBy('id','desc')->paginate(5);
        // $projectlogs = ProjectLog::where('mini_tbp_id',$minitbp->id)->whereJsonContains('viewer', $auth->id)->orderBy('id','desc')->paginate(7);
        return view('dashboard.company.report.index')->withBusinessplans($businessplans)
                                                ->withAlertmessages($alertmessages)
                                                ->withTimelinehistories($timelinehistories);
    }

    public function GetEvent(Request $request){
        $eventcalendarattendees = EventCalendarAttendee::where('user_id',Auth::user()->id)->pluck('event_calendar_id')->toArray();
        // $eventcalendars = EventCalendar::whereIn('id',$eventcalendarattendees)->get();

        $eventcalendars = EventCalendar::whereNotNull('subject')
                                    ->whereNotNull('eventdate')
                                    ->whereNotNull('starttime')
                                    ->whereNotNull('endtime')
                                    ->whereNotNull('place')
                                    ->whereNotNull('summary')
                                    ->whereIn('id',$eventcalendarattendees)->get();
    
        $_events = array();
        foreach ($eventcalendars as $event) {
            $_events[] = array('start' => $event->eventdate, 'summary' => $event->summary);
        }
        return collect($_events);
    }

    public function GetFinalGrade(Request $request){
        $auth = Auth::user();
        $company = Company::where('user_id',$auth->id)->first();
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        $ev = Ev::where('full_tbp_id',$fulltbp->id)->first();
        $finalgrade = FinalGrade::where('ev_id',$ev->id)->get();
        return response()->json($finalgrade); 
    }
    

    public function GetTimeLine(Request $request){
        $timelinehistories = TimeLineHistory::where('owner_id',$request->userid)->orderBy('id','desc')->get();
        return response()->json($timelinehistories); 
    }

    public function EditTimeLineStatus(Request $request){
        TimeLineHistory::find($request->id)->update([
            'status' => '1'
        ]);

        $timelinehistories = TimeLineHistory::where('owner_id',$request->userid)->get();
        return response()->json($timelinehistories); 
    }

    public function SingleReport($id){
        $auth = Auth::user();
        $alertmessages = AlertMessage::where('target_user_id',$auth->id)->get();
        $businessplans = BusinessPlan::where('company_id',Company::where('user_id',$auth->id)->first()->id)->get();
        $timelinehistories = TimeLineHistory::where('business_plan_id',$id)->orderBy('id','desc')->paginate(5);
        $businessplan = BusinessPlan::find($id);
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltbp = FullTbp::where('mini_tbp_id',$minitbp->id)->first();
        if(!Empty($fulltbp->canceldate)){
            return redirect()->route('dashboard.company.report')->withError('โครงการถูกยกเลิกแล้ว');
        }
        return view('dashboard.company.report.singlereport')->withBusinessplans($businessplans)
                                                ->withAlertmessages($alertmessages)
                                                ->withTimelinehistories($timelinehistories)
                                                ->withBusinessplan($businessplan);
    }
    
}
