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

class ReportProjectExportCancelByYearBudget implements FromView,ShouldAutoSize,WithTitle
{
    protected $startdate;
    protected $enddate;
    protected $year;
    protected $projectname;
    function __construct($startdate,$enddate,$year) {
        $this->projectname = 'โครงการยกเลิก ปีงบประมาณ ' . (intVal($year)+543) ;
        $this->year = $year;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }
    public function view(): View
    {
        $fulltbps = FullTbp::whereBetween('canceldate',[$this->startdate, $this->enddate])->whereNotNull('canceldate')->get();
        
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
