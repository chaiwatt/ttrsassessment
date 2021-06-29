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
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByExpert implements FromView,ShouldAutoSize,WithTitle
{
    protected $expert;
    protected $projectname;
    function __construct($expert) {
        $this->projectname = ' โครงการแยกตาม Expert';
           $this->expert = $expert;
    }
    public function view(): View
    {
        $fulltbparray = ExpertAssignment::where('user_id',$this->expert)->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id',$fulltbparray)->get();
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}
