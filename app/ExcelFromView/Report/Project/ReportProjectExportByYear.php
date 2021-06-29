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
    //protected $year;
    protected $projectname;
    function __construct() {
        $this->projectname = ' โครงการทั้งหมด' ;
        //$this->year = $year;
    }
    public function view(): View
    {
        $fulltbps = FullTbp::get();
        return view('dashboard.admin.realtimereport.project.downloadallbyyear', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
