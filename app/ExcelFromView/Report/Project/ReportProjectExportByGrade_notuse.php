<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\ProjectGrade;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByGrade implements FromView,ShouldAutoSize
{
    protected $startdate;
    protected $enddate;
    protected $grade;
    function __construct($startdate,$enddate,$grade) {
           $this->startdate = $startdate;
           $this->enddate = $enddate;
           $this->grade = $grade;
    }
    public function view(): View
    {
        $start_date = Carbon::parse($this->startdate)
                ->toDateTimeString();

        $end_date = Carbon::parse($this->enddate)
                ->toDateTimeString();
        $projectgrades = ProjectGrade::where('grade',$this->grade)->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id', $projectgrades)->whereBetween('created_at', [$this->startdate, $this->enddate])->get();
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
}
