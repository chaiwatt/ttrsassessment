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

class ReportProjectExportFinishedByYearBudget implements FromView,ShouldAutoSize,WithTitle
{
    protected $startdate;
    protected $enddate;
    protected $year;
    protected $projectname;
    function __construct($startdate,$enddate,$year) {
        $this->projectname = 'ประเมินเสร็จ ปีงบประมาณ ' . (intVal($year)+543) ;
        $this->year = $year;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }
    public function view(): View
    {
        $fulltbps = FullTbp::whereBetween('submitdate',[$this->startdate, $this->enddate])->whereNotNull('finishdate')->get();
        
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
