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

class ReportProjectExportFullTbpByYearBudget implements FromView,ShouldAutoSize,WithTitle
{
    protected $startdate;
    protected $enddate;
    protected $projectname;
    protected $year;
    function __construct($startdate,$enddate,$year) {
        $this->projectname = 'Full Tbp ปีงบประมาณ ' ;
        if($year > 0){
            $this->projectname = 'Full Tbp ปีงบประมาณ ' . (intVal($year)+543) ;
        }
        
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }
    public function view(): View
    {

        if($this->year > 0){
            $fulltbps = FullTbp::whereNotNull('submitdate')->whereBetween('submitdate',[$this->startdate, $this->enddate])->orderBy('fulltbp_code','asc')->get();
        }else{
            $fulltbps = FullTbp::whereNotNull('submitdate')->orderBy('fulltbp_code','asc')->get();
        }

        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
