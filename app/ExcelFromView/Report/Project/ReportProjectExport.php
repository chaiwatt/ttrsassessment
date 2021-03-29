<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExport implements FromView,ShouldAutoSize
{
    protected $startdate;
    protected $enddate;

    function __construct($startdate,$enddate) {
           $this->startdate = $startdate;
           $this->enddate = $enddate;
    }
    public function view(): View
    {
        $start_date = Carbon::parse($this->startdate)
                ->toDateTimeString();

        $end_date = Carbon::parse($this->enddate)
                ->toDateTimeString();

        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => FullTbp::whereBetween('created_at',[$start_date,$end_date])->orderBy('id','desc')->get()
        ]);
    }
}
