<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Grade;
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

class ReportProjectExportByCertificate implements FromView,ShouldAutoSize,WithTitle
{
    protected $status;
    protected $projectname;
    function __construct($status) {
        $this->projectname = ' โครงการแยกตามเกรด';
           $this->status = $status;
    }
    public function view(): View
    {
        $businessplanarray = BusinessPlan::where('business_plan_status_id',10)->pluck('id')->toArray();
        if($this->status != 1){
            $businessplanarray = BusinessPlan::where('business_plan_status_id','!=',10)->pluck('id')->toArray();
        }
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->orderBy('fulltbp_code','asc')->get();
        return view('dashboard.admin.realtimereport.project.downloadcertificate', [
            'fulltbps' => $fulltbps
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}
