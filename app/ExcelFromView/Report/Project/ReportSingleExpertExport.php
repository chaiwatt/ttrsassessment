<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\expertDetail;
use App\Model\ExpertDetail;
use App\Model\ProjectMember;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\ExcelFromView\Report\Project\ReportSingleExpertExportSheet;
use App\ExcelFromView\Report\Project\ReportTTRSSingleexpertExportSheet;
use App\ExcelFromView\Report\Project\ReportSingleExpertExportFirstSheet;

class ReportSingleExpertExport implements WithMultipleSheets
{
    use Exportable;

    protected $userid;

    function __construct($userid) {
           $this->userid = $userid;
    }
    
    public function sheets(): array
    {
        $sheets = [];
        $projectmembers = ProjectMember::where('user_id',$this->userid)->get();
        $expert = ExpertDetail::where('user_id',$this->userid)->first();
        $sheets[] = new ReportSingleExpertExportFirstSheet($expert->id);
        foreach ($projectmembers as $key => $projectmember) {
            $sheets[] = new ReportSingleExpertExportSheet($projectmember->full_tbp_id,$this->userid);
        }
        return $sheets; 
    }
}
