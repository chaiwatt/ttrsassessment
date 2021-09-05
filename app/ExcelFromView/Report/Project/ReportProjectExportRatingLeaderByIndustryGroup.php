<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Grade;
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

class ReportProjectExportRatingLeaderByIndustryGroup implements FromView,ShouldAutoSize,WithTitle
{
    protected $leader;
    protected $industrygroup;
    protected $projectname;
    function __construct($leader,$industrygroup) {
        $this->projectname = 'ระหว่างการประเมินของ Lead รายอุตสาหกรรม';
           $this->leader = $leader;
           $this->industrygroup = $industrygroup;
    }
    public function view(): View
    {
        if($this->leader == 0 && $this->industrygroup == 0){
            $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->get();
        }else if($this->leader != 0 && $this->industrygroup != 0){
            $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps1 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            $fulltbparray = ProjectAssignment::where('leader_id',$this->leader)->pluck('full_tbp_id')->toArray();
            $fulltbps2 = FullTbp::whereNotNull('submitdate')->whereIn('id',$fulltbparray)->pluck('id')->toArray();
           
            $companies = Company::where('industry_group_id',$this->industrygroup)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps3 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
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
        }else if($this->leader == 0 && $this->industrygroup != 0){
            $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps1 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            $fulltbparray = ProjectAssignment::pluck('full_tbp_id')->toArray();
            $fulltbps2 = FullTbp::whereNotNull('submitdate')->whereIn('id',$fulltbparray)->pluck('id')->toArray();
           
            $companies = Company::where('industry_group_id',$this->industrygroup)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps3 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
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
        }else if($this->leader != 0 && $this->industrygroup == 0){
            $businessplanarray = BusinessPlan::where('business_plan_status_id','<',10)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps1 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            $fulltbparray = ProjectAssignment::where('leader_id',$this->leader)->pluck('full_tbp_id')->toArray();
            $fulltbps2 = FullTbp::whereNotNull('submitdate')->whereIn('id',$fulltbparray)->pluck('id')->toArray();
           
            $companies = Company::pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps3 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
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
