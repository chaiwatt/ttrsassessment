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

class ReportProjectExportByYear implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $projectname;
    function __construct($year) {
        if($year == 0){
            $this->projectname = 'โครงการทั้งหมด' ;
        }else{
            $this->projectname = 'ปี' . (intVal($year) + 543);
        }
        $this->year = $year;
    }
    public function view(): View
    {
        if($this->year == 0){
            $fulltbps = FullTbp::whereNotNull('submitdate')->get();
        }else{
            $fulltbps = FullTbp::whereNotNull('submitdate')->whereYear('submitdate',$this->year)->get();
        }

        return view('dashboard.admin.realtimereport.project.downloadallbyyear', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
