<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\OfficerDetail;
use App\Model\ProjectMember;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\ExcelFromView\Report\Project\ReportTTRSSingleOfficerExportSheet;
use App\ExcelFromView\Report\Project\ReportNumprojectExportMultipleSheet;

class ReportNumprojectExportSheet implements WithMultipleSheets
{
    use Exportable;

    function __construct() {
          
    }
    
    public function sheets(): array
    {
        $years = array_reverse(BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray());
        // dd("ok");
        // $sheets = [];
        // $projectmembers = ProjectMember::where('user_id',$this->userid)->get();
        // $officer = OfficerDetail::where('user_id',$this->userid)->first();
         $sheets[] = new ReportNumprojectExportFirstSheet($years);
        foreach ($years as $key => $year) {
            $sheets[] = new ReportNumprojectExportMultipleSheet($year);
        }
        return $sheets; 
    }
}
