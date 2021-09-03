<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\ProjectGrade;
use App\Model\ProjectBudget;
use App\Model\EvaluationMonth;
use App\Model\FullTbpInvestment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByBudget implements FromView,ShouldAutoSize,WithTitle
{
    protected $projectbudget;
    protected $projectname;
    function __construct($projectbudget) {
        $this->projectname = ' โครงการตามงบประมาณ';
        $this->projectbudget = $projectbudget;
    }
    public function view(): View
    {
        if($this->projectbudget != 0){
            $projectbudgetcapital = ProjectBudget::find($this->projectbudget);
            $fulltbpinvestmentarr = FullTbpInvestment::distinct('full_tbp_id')->pluck('full_tbp_id')->toArray();
            $arr = array();
            foreach ($fulltbpinvestmentarr as $key => $item) {
                $check = FullTbpInvestment::where('full_tbp_id',$item)->sum('cost');
                if($check >= $projectbudgetcapital->minbudget && $check <= $projectbudgetcapital->maxbudget){
                    array_push($arr,$item);
                }
            }
            $fulltbps = FullTbp::whereIn('id',$arr)->get();
        }else{
            $fulltbps = FullTbp::get();
        }

        return view('dashboard.admin.realtimereport.project.downloadallbyprojectbudget', [
            'fulltbps' => $fulltbps
        ]);
    }
    public function title(): string
    {
        return $this->projectname;
    }
}
