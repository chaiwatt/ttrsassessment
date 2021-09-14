<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Province;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\ProjectGrade;
use App\Model\CompanyAddress;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByProvince implements FromView,ShouldAutoSize,WithTitle
{
    protected $province;
    protected $projectname;
    function __construct($province) {

        if($province == 0){
            $this->projectname = 'โครงการแยกตามจังหวัด';
        }else{
            $this->projectname = 'โครงการ จังหวัด' . Province::find($province)->name;
        }
           $this->province = $province;
    }
    public function view(): View
    {
        if($this->province != 0){
            $addressarray = array_unique(CompanyAddress::where('province_id',$this->province)->pluck('company_id')->toArray());
            $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->orderBy('fulltbp_code','asc')->get();
        }else{
            $minitbparray = MiniTbp::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->orderBy('fulltbp_code','asc')->get();
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
