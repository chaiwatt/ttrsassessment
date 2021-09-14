<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Sector;
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

class ReportProjectExportBySector implements FromView,ShouldAutoSize,WithTitle
{
    protected $sector;
    protected $projectname;
    function __construct($sector) {
        if($sector != 0){
            $this->projectname = ' โครงการ ภาค' . Sector::find($sector)->name;
        }else{
            $this->projectname = ' โครงการแยกตามภูมิภาค';
        }
        
        $this->sector = $sector;
    }
    public function view(): View
    {
        if($this->sector != 0){
            $provincearray = Province::where('map_code',$this->sector)->pluck('id')->toArray();
            $addressarray = array_unique(CompanyAddress::whereIn('province_id',$provincearray)->whereNull('addresstype')->pluck('company_id')->toArray());
            $companies = Company::whereIn('id',$addressarray)->pluck('id')->toArray();
            $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
            $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->orderBy('fulltbp_code','asc')->get();
        }else{
            // $fulltbps = FullTbp::whereNotNull('submitdate')->get();
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
