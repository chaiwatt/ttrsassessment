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
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByBusinessPlanStatus implements FromView,ShouldAutoSize,WithTitle
{
    protected $businessplanstatus;
    protected $projectname;
    function __construct($businessplanstatus) {
        $this->projectname = ' โครงการแยกตามสถานะของการประเมิน';
           $this->businessplanstatus = $businessplanstatus;
    }
    public function view(): View
    {
        $businessplanarray = BusinessPlan::where('business_plan_status_id',$this->businessplanstatus)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->orderBy('fulltbp_code','asc')->get();
        return view('dashboard.admin.realtimereport.project.downloadbusinessplanstatus', [
            'fulltbps' => $fulltbps
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}
