<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\ProjectGrade;
use App\Model\EvaluationMonth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportMiniTbpByYearBudget implements FromView,ShouldAutoSize,WithTitle
{
    protected $startdate;
    protected $enddate;
    protected $projectname;
    protected $year;
    function __construct($startdate,$enddate,$year) {
        $this->projectname = 'Mini Tbp ปีงบประมาณ ' . (intVal($year)+543) ;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }
    public function view(): View
    {
        $minitbparray = MiniTbp::whereBetween('submitdate',[$this->startdate, $this->enddate])->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();

        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
