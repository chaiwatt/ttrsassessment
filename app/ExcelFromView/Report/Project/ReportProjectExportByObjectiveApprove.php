<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Grade;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\ProjectGrade;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByObjectiveApprove implements FromView,ShouldAutoSize,WithTitle
{
    protected $objecttivetype;
    protected $projectname;
    function __construct($objecttivetype) {
        $this->projectname = 'ตามผลอนุมัติตามวัตถุประสงค์';
           $this->objecttivetype = $objecttivetype;
    }
    public function view(): View
    {
        $minitbparray = MiniTBP::whereNotNull('finance1')
                ->orWhereNotNull('finance2')
                ->orWhereNotNull('finance3')
                ->orWhereNotNull('finance4')
                ->pluck('id')->toArray();

        if($this->objecttivetype != 1){
        $minitbparray = MiniTBP::whereNotNull('nonefinance1')
                    ->orWhereNotNull('nonefinance2')
                    ->orWhereNotNull('nonefinance3')
                    ->orWhereNotNull('nonefinance4')
                    ->orWhereNotNull('nonefinance5')
                    ->orWhereNotNull('nonefinance6')
                    ->pluck('id')->toArray();
        }

        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->where('success_objective',1)->get();

        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}
