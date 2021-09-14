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

class ReportProjectExportIndustryGroupBySector implements FromView,ShouldAutoSize,WithTitle
{
    protected $industrygroup;
    protected $sector;
    protected $projectname;
    function __construct($industrygroup,$sector) {
        $this->projectname = 'ประเภทอุตสาหกรรมในแต่ละภูมิภาค';
           $this->industrygroup = $industrygroup;
           $this->sector = $sector;
    }
    public function view(): View
    {
        // if($this->industrygroup == 0 && $this->sector == 0){
        //     $fulltbps = FullTbp::whereNotNull('submitdate')->get();
        // }else if($this->industrygroup != 0 && $this->sector != 0){
        //     $companies = Company::where('industry_group_id',$this->industrygroup)->pluck('id')->toArray();
        //     $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        //     $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        //     $fulltbps1 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
        //     $provincearray = Province::where('map_code',$this->sector)->pluck('id')->toArray();
        //     $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());           
        //     $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        //     $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        //     $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        //     $fulltbps2 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
        //     $intersec = array();
        //     foreach($fulltbps1 as $f1) {
        //         if (in_array($f1,$fulltbps2)) {
        //             array_push($intersec,$f1);
        //         } 
        //     }
            
        //     $fulltbps = FullTbp::whereNotNull('submitdate')->whereIn('id', $intersec)->get();
        // }else if($this->industrygroup == 0 && $this->sector != 0){

        //     $fulltbps1 = FullTbp::whereNotNull('submitdate')->pluck('id')->toArray();
    
        //     $provincearray = Province::where('map_code',$this->sector)->pluck('id')->toArray();
        //     $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());           
        //     $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
        //     $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        //     $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        //     $fulltbps2 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
        //     $intersec = array();
        //     foreach($fulltbps1 as $f1) {
        //         if (in_array($f1,$fulltbps2)) {
        //             array_push($intersec,$f1);
        //         } 
        //     }
            
        //     $fulltbps = FullTbp::whereNotNull('submitdate')->whereIn('id', $intersec)->get();

        // }else if($this->industrygroup != 0 && $this->sector == 0){
        //     $companies = Company::where('industry_group_id',$this->industrygroup)->pluck('id')->toArray();
        //     $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        //     $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        //     $fulltbps1 = FullTbp::whereNotNull('submitdate')->whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
        //     $fulltbps2 = FullTbp::whereNotNull('submitdate')->pluck('id')->toArray();
    
        //     $intersec = array();
        //     foreach($fulltbps1 as $f1) {
        //         if (in_array($f1,$fulltbps2)) {
        //             array_push($intersec,$f1);
        //         } 
        //     }
            
        //     $fulltbps = FullTbp::whereNotNull('submitdate')->whereIn('id', $intersec)->get();
        // }

        if($this->industrygroup == 0 && $this->sector == 0){
            // $fulltbps = FullTbp::whereNotNull('submitdate')->get();
            $minitbparray = MiniTbp::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->orderBy('fulltbp_code','asc')->get();
        }else if($this->industrygroup != 0 && $this->sector != 0){
            $companies = Company::where('industry_group_id',$this->industrygroup)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            
            $provincearray = Province::where('map_code',$this->sector)->pluck('id')->toArray();
            $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());           
            $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            $intersec = array();
            foreach($fulltbps1 as $f1) {
                if (in_array($f1,$fulltbps2)) {
                    array_push($intersec,$f1);
                } 
            }
            $fulltbps = FullTbp::whereIn('id', $intersec)->orderBy('fulltbp_code','asc')->get();
        }else if($this->industrygroup == 0 && $this->sector != 0){
            // $fulltbps1 = FullTbp::whereNotNull('submitdate')->pluck('id')->toArray();

            $_minitbparray = MiniTbp::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $_minitbparray)->pluck('id')->toArray();

            $provincearray = Province::where('map_code',$this->sector)->pluck('id')->toArray();
            $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());           
            $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            $intersec = array();
            foreach($fulltbps1 as $f1) {
                if (in_array($f1,$fulltbps2)) {
                    array_push($intersec,$f1);
                } 
            }
            $fulltbps = FullTbp::whereIn('id', $intersec)->orderBy('fulltbp_code','asc')->get();

        }else if($this->industrygroup != 0 && $this->sector == 0){
            $companies = Company::where('industry_group_id',$this->industrygroup)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            // $fulltbps2 = FullTbp::whereNotNull('submitdate')->pluck('id')->toArray();
            $_minitbparray = MiniTbp::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $_minitbparray)->pluck('id')->toArray();
    
            $intersec = array();
            foreach($fulltbps1 as $f1) {
                if (in_array($f1,$fulltbps2)) {
                    array_push($intersec,$f1);
                } 
            }
            $fulltbps = FullTbp::whereIn('id', $intersec)->orderBy('fulltbp_code','asc')->get();
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
