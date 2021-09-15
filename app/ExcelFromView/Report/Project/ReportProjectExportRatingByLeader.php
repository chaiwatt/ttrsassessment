<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Grade;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Province;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\ProjectGrade;
use App\Model\IndustryGroup;
use App\Model\CompanyAddress;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\BusinessPlanStatus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportRatingByLeader implements FromView,ShouldAutoSize,WithTitle
{
    protected $leader;
    protected $projectname;
    function __construct($leader) {
        $this->projectname = ' โครงการระหว่างการประเมินของ Lead';
           $this->leader = $leader;
    }
    public function view(): View
    {
        // $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        // $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        // $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        $minitbparray = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereNull('finishdate')->pluck('id')->toArray();

        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$this->leader)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->whereNull('finishdate')->pluck('id')->toArray();
        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }

        if($this->leader == 0){
            $minitbparray = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereNull('finishdate')->orderBy('fulltbp_code','asc')->get();
        }else{
            $fulltbps = FullTbp::whereIn('id', $intersec)->whereNull('finishdate')->orderBy('fulltbp_code','asc')->get();
        }

        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}
