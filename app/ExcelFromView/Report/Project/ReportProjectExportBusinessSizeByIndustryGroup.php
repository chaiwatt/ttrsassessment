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
use App\Model\IndustryGroup;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Model\BusinessPlanStatus;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportBusinessSizeByIndustryGroup implements FromView,ShouldAutoSize,WithTitle
{
    protected $companysize;
    protected $industrygroup;
    protected $projectname;
    function __construct($companysize,$industrygroup) {
        $this->projectname = 'ขนาดธุรกิจในแต่ละอุตสาหกรรม ';
           $this->companysize = $companysize;
           $this->industrygroup = $industrygroup;
    }
    public function view(): View
    {
        // $companies = Company::where('company_size_id',$this->companysize)->pluck('id')->toArray();
        // $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        // $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        // $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        // $companies = Company::where('industry_group_id',$this->industrygroup)->pluck('id')->toArray();
        // $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        // $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        // $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();

        // $intersec = array();
        // foreach($fulltbps1 as $f1) {
        //     if (in_array($f1,$fulltbps2)) {
        //         array_push($intersec,$f1);
        //     } 
        // }
        // $fulltbps = FullTbp::whereIn('id', $intersec)->get();
        if($this->industrygroup == 0){
            $companies = Company::where('company_size_id',$this->companysize)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            
            $companies = Company::pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            $intersec = array();
            foreach($fulltbps1 as $f1) {
                if (in_array($f1,$fulltbps2)) {
                    array_push($intersec,$f1);
                } 
            }
            $fulltbps = FullTbp::whereIn('id', $intersec)->orderBy('fulltbp_code','asc')->get();
        }else{
            $companies = Company::where('company_size_id',$this->companysize)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps1 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
            
            $companies = Company::where('industry_group_id',$this->industrygroup)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps2 = FullTbp::whereIn('mini_tbp_id', $minitbparray)->pluck('id')->toArray();
    
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
