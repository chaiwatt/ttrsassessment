<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\OfficerDetail;
use App\Model\ProjectMember;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\ExcelFromView\Report\Project\ReportTTRSSingleOfficerExportSheet;

class ReportTTRSSingleOfficerExport implements WithMultipleSheets
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
        $officer = OfficerDetail::where('user_id',$this->userid)->first();
        $sheets[] = new ReportTTRSSingleOfficerExportFirstSheet($officer->id);
        foreach ($projectmembers as $key => $projectmember) {
            $sheets[] = new ReportTTRSSingleOfficerExportSheet($projectmember->full_tbp_id,$this->userid);
        }
        return $sheets; 
    }
}
