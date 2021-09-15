<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ProjectGrade;
use App\Model\EvaluationMonth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByProjectAll implements FromView,ShouldAutoSize,WithTitle
{
    protected $projectname;
    function __construct() {
        $this->projectname = 'โครงการระหว่างการประเมินทั้งหมด' ;
    }
    public function view(): View
    {
        
        $minitbparray = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereNull('finishdate')->orderBy('fulltbp_code','asc')->get();
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
