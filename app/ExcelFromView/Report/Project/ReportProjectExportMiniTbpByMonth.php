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

class ReportProjectExportMiniTbpByMonth implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $month;
    protected $projectname;
    function __construct($year,$month) {
     $_m = (string)((int)($month));
        $this->projectname = 'Mini Tbp-' . EvaluationMonth::find($_m)->name . ' ปี พ.ศ.' . (intVal($year)+543) ;
        $this->year = $year;
        $this->month = $month;
    }
    public function view(): View
    {
        $minitbparray = MiniTBP::whereMonth('submitdate',$this->month)->whereYear('submitdate',$this->year)->pluck('id')->toArray();
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
