<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\DownloadStat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportDocDownload implements FromView,ShouldAutoSize
{
    protected $startdate;
    protected $enddate;

    function __construct($startdate,$enddate) {
           $this->startdate = $startdate;
           $this->enddate = $enddate;
    }
    public function view(): View
    {

        $downloadstats = DownloadStat::whereBetween('created_at', [$this->startdate, $this->enddate])->get();

        return view('dashboard.admin.realtimereport.project.exceldownload', [
            'downloadstats' => $downloadstats
        ]);
    }
}
