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

class ReportProjectExportFinishedByYear implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $projectname;
    function __construct($year) {
        if($year == 0){
            $this->projectname = 'ประเมินเสร็จ';
        }else{
            $this->projectname = 'ประเมินเสร็จ พ.ศ.' . (intVal($year)+543) ;
        }
        
        $this->year = $year;
    }
    public function view(): View
    {
        if($this->year == 0){
            $fulltbps = FullTbp::whereNotNull('finishdate')->get();
        }else{
            $fulltbps = FullTbp::whereYear('finishdate',$this->year)->whereNotNull('finishdate')->get();
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
