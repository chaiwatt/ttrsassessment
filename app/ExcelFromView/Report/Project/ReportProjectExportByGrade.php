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

class ReportProjectExportByGrade implements FromView,ShouldAutoSize,WithTitle
{
    protected $grade;
    protected $projectname;
    function __construct($grade) {
        $this->projectname = ' โครงการแยกตามเกรด';
           $this->grade = $grade;
    }
    public function view(): View
    {
        $grade = Grade::find($this->grade);
        $projectgradearray = ProjectGrade::where('grade',$grade->name)->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id', $projectgradearray)->get();
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}
