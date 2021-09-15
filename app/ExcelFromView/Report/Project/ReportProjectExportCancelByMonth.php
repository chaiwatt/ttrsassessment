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

class ReportProjectExportCancelByMonth implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $month;
    protected $projectname;
    function __construct($year,$month) {
     $_m = (string)((int)($month));
        $this->projectname = ' โครงการยกเลิก-' . EvaluationMonth::find($_m)->name . ' พ.ศ.' . (intVal($year)+543) ;
        $this->year = $year;
        $this->month = $month;
    }
    public function view(): View
    {
        if($this->year == 0 && $this->month == '00'){
            $fulltbps = FullTbp::whereNotNull('canceldate')->orderBy('fulltbp_code','asc')->get();
        }else if($this->year != 0 && $this->month != '00'){
            $fulltbps = FullTbp::whereNotNull('canceldate')->whereMonth('canceldate',$this->month)->whereYear('canceldate',$this->year)->orderBy('fulltbp_code','asc')->get();
        }else if($this->year == 0 && $this->month != '00'){
            $fulltbps = FullTbp::whereNotNull('canceldate')->whereMonth('canceldate',$this->month)->orderBy('fulltbp_code','asc')->get();
        }else if($this->year != 0 && $this->month == '00'){
            $fulltbps = FullTbp::whereNotNull('canceldate')->whereYear('canceldate',$this->year)->orderBy('fulltbp_code','asc')->get();
        }
        

        // $fulltbps = FullTbp::whereNotNull('canceldate')->whereMonth('canceldate',$this->month)->whereYear('canceldate',$this->year)->get();
        //$fulltbps = FullTbp::whereMonth('submitdate',$this->month)->whereYear('submitdate',$this->year)->whereNotNull('canceldate')->get();
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
