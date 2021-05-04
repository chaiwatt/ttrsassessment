<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Grade;
use App\Model\Sector;
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

class ReportProjectExportByLeadColeadExpert implements FromView,ShouldAutoSize,WithTitle
{
    protected $fulltbp;
    protected $projectname;
    function __construct($fulltbp) {
        $_check = FullTbp::find($fulltbp);
        $minitbp = MiniTbp::find($_check->mini_tbp_id);
        $this->projectname = $minitbp->project;
        $this->fulltbp = $fulltbp;
    }
    public function view(): View
    {
        $businessplanarray = BusinessPlan::where('business_plan_status_id','>',3)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
        $fulltbp = FullTbp::find($this->fulltbp);
        $minitbp = MiniTbp::find($fulltbp->mini_tbp_id);
        $businessplan = BusinessPlan::find($minitbp->business_plan_id);
        $projectassignment = ProjectAssignment::where('business_plan_id',$businessplan->id)->first();
        $expertassignments = ExpertAssignment::where('full_tbp_id',$fulltbp->id)->get();

        return view('dashboard.admin.realtimereport.project.downloadleadcoleadexpert', [
            'fulltbps' => $fulltbps,
            'expertassignments' => $expertassignments,
            'projectassignment' => $projectassignment,
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}
