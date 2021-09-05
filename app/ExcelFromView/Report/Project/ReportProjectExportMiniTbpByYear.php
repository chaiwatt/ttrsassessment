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

class ReportProjectExportMiniTbpByYear implements FromView,ShouldAutoSize,WithTitle
{
    protected $year;
    protected $projectname;
    function __construct($year) {
        if($year == 0){
            $this->projectname = 'Mini Tbp';
        }else{
            $this->projectname = 'Mini Tbp ปี พ.ศ.' . (intVal($year)+543) ;
        }
        
        $this->year = $year;
    }
    public function view(): View
    {
        if($this->year == 0){
            $minitbparr = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id',$minitbparr)->get();
        }else{
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereYear('submitdate',$this->year)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();
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
