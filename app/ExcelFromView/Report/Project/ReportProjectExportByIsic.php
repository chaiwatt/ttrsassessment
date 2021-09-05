<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
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

class ReportProjectExportByIsic implements FromView,ShouldAutoSize,WithTitle
{
    protected $isic;
    protected $projectname;
    function __construct($isic) {
        $this->projectname = ' โครงการแยกตาม ISIC Code';
           $this->isic = $isic;
    }
    public function view(): View
    {
        if($this->isic != 0){
            $companies = Company::where('isic_id',$this->isic)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->get();
        }else{
            $fulltbps = FullTbp::whereNotNull('submitdate')->get();
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
