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

class ReportProjectExportByScore implements FromView,ShouldAutoSize,WithTitle
{
    protected $score;
    protected $projectname;
    function __construct($score) {
        $this->projectname = 'โครงการแยกตามคะแนน';
           $this->score = $score;
    }
    public function view(): View
    {
        $score = Grade::find($this->score);
        // $projectgradearray = ProjectGrade::where('percent','>=',$score->min)->where('percent','<',$score->max)->pluck('full_tbp_id')->toArray();
        $projectgradearray = ProjectGrade::whereBetween('percent', [intVal($score->min), intVal($score->max)])->pluck('full_tbp_id')->toArray();
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
