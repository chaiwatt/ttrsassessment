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

class ReportProjectExportFullTbpByMonth implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $month;
    protected $projectname;
    function __construct($year,$month) {
        $_m = (string)((int)($month));
        $this->projectname = 'Full Tbp';
        if($year == 0 && $month != '00'){
            $this->projectname = 'Full Tbp-' . EvaluationMonth::find($_m)->name;
        }else if($year != 0 && $month == '00'){
            $this->projectname = 'Full Tbp พ.ศ.' . (intVal($year)+543) ;
        }else if($year != 0 && $month != '00'){
            $this->projectname = 'Full Tbp-' . EvaluationMonth::find($_m)->name . ' พ.ศ.' . (intVal($year)+543) ;
        }
       
        $this->year = $year;
        $this->month = $month;
    }
    public function view(): View
    {

        if($this->year == 0){
            if($this->month == '00'){
                $fulltbps = FullTbp::whereNotNull('submitdate')->get();
            }else{
                $fulltbps = FullTbp::whereNotNull('submitdate')->whereMonth('submitdate',$this->month)->get();
            }
        }else{
            if($this->month == '00'){
                $fulltbps = FullTbp::whereNotNull('submitdate')->whereYear('submitdate',$this->year)->get();
            }else{
                $fulltbps = FullTbp::whereNotNull('submitdate')->whereMonth('submitdate',$this->month)->whereYear('submitdate',$this->year)->get();
            }
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
