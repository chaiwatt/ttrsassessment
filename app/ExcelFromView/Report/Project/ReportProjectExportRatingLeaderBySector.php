<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Grade;
use App\Model\Sector;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Province;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\ProjectGrade;
use App\Model\IndustryGroup;
use App\Model\CompanyAddress;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\BusinessPlanStatus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportRatingLeaderBySector implements FromView,ShouldAutoSize,WithTitle
{
    protected $leader;
    protected $sector;
    protected $projectname;
    function __construct($leader,$sector) {
        $this->projectname = 'ระหว่างการประเมินของ Lead แต่ภาค';
           $this->leader = $leader;
           $this->sector = $sector;
    }
    public function view(): View
    {
        $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
        $leaderarray = ProjectAssignment::whereNotNull('leader_id')->pluck('leader_id')->toArray();
        $leaders = User::whereIn('id',$leaderarray)->get();
        $fulltbparray = ProjectAssignment::where('leader_id',$this->leader)->pluck('full_tbp_id')->toArray();
        $fulltbps2 = FullTbp::whereIn('id',$fulltbparray)->pluck('id')->toArray();
        
        $sectors = Sector::get();
        $provincearray = Province::where('map_code',$this->sector)->pluck('id')->toArray();
        $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());           
        $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps3 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
        $_intersec = array();
        foreach($fulltbps1 as $f1) {
            if (in_array($f1,$fulltbps2)) {
                array_push($_intersec,$f1);
            } 
        }
    
        $intersec = array();
        foreach($_intersec as $f1) {
            if (in_array($f1,$fulltbps3)) {
                array_push($intersec,$f1);
            } 
        }

        $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }

    public function title(): string
    {
        return $this->projectname;
    }
}
