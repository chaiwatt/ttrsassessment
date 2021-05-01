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

class ReportProjectExportFullTbpByYear implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $projectname;
    function __construct($year) {
        $this->projectname = 'Full Tbp พ.ศ.' . (intVal($year)+543) ;
        $this->year = $year;
    }
    public function view(): View
    {
        $fulltbps = FullTbp::whereYear('submitdate',$this->year)->get();
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
