<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\ProjectGrade;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\BusinessPlanStatus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportExpertByBusinessPlanStatus implements FromView,ShouldAutoSize,WithTitle
{
    protected $expert;
    protected $businessplanstatus;
    protected $projectname;
    function __construct($expert,$businessplanstatus) {
        $this->projectname = 'Expertแยกตามสถานะการประเมิน';
           $this->expert = $expert;
           $this->businessplanstatus = $businessplanstatus;
    }
    public function view(): View
    {
        $fulltbparray = ExpertAssignment::where('user_id',$this->expert)->pluck('full_tbp_id')->toArray();
        $fulltbps1 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();

        $businessplanstatuses = BusinessPlanStatus::get();
        $businessplanarray = BusinessPlan::where('business_plan_status_id',$this->businessplanstatus)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
        $intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($intersec,$f1);
            } 
        }
        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.downloadbusinessplanstatus', [
            'fulltbps' => $fulltbps
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}


