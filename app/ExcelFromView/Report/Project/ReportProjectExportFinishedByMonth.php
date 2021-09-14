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

class ReportProjectExportFinishedByMonth implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $month;
    protected $projectname;
    function __construct($year,$month) {
     $_m = (string)((int)($month));
     if($_m == '00'){
        $this->projectname = 'ประเมินเสร็จ-พ.ศ.' . (intVal($year)+543) ;
     }else{
        $this->projectname = 'ประเมินเสร็จ-' . EvaluationMonth::find($_m)->name . ' พ.ศ.' . (intVal($year)+543) ;
     }
        
        $this->year = $year;
        $this->month = $month;
    }
    public function view(): View
    {
        if($this->year == 0){
            if($this->month == '00'){
                $fulltbps = FullTbp::whereNotNull('finishdate')->orderBy('fulltbp_code','asc')->get();
            }else{
                $fulltbps = FullTbp::whereMonth('finishdate',$this->month)->whereNotNull('finishdate')->orderBy('fulltbp_code','asc')->get();
            }
        }else{
            if($this->month == '00'){
                $fulltbps = FullTbp::whereYear('finishdate',$this->year)->whereNotNull('finishdate')->orderBy('fulltbp_code','asc')->get();
            }else{
                $fulltbps = FullTbp::whereMonth('finishdate',$this->month)->whereYear('finishdate',$this->year)->whereNotNull('finishdate')->orderBy('fulltbp_code','asc')->get();
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
