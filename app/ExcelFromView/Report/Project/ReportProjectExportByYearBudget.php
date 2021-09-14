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

class ReportProjectExportByYearBudget implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $projectname;
    protected $startdate;
    protected $enddate;
    function __construct($startdate,$enddate,$year) {
        if($year > 0){
            $this->projectname = 'ปีงบประมาณ' .(intVal($year) + 543) ;
        }else{
            $this->projectname = 'โครงการทั้งหมดตามปีงบประมาณ' ;
        }
        
        $this->year = $year;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }
    public function view(): View
    {
        // if($this->year > 0){
        //     $fulltbps = FullTbp::whereNotNull('submitdate')->whereBetween('submitdate',[$this->startdate, $this->enddate])->get();

        // }else{
        //     $fulltbps = FullTbp::whereNotNull('submitdate')->get();
        // }

        if($this->year > 0){
            $minitbparray = MiniTbp::whereNotNull('submitdate')->whereBetween('submitdate',[$this->startdate, $this->enddate])->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->orderBy('fulltbp_code','asc')->get();
        }else{
            $minitbparray = MiniTbp::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->orderBy('fulltbp_code','asc')->get();
        }

        return view('dashboard.admin.realtimereport.project.downloadallbyyearbudget', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
