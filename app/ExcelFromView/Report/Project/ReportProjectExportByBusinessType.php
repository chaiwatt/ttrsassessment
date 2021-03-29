<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ProjectGrade;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByBusinessType implements FromView,ShouldAutoSize
{
    protected $startdate;
    protected $enddate;
    protected $businesstype;
    function __construct($startdate,$enddate,$businesstype) {
           $this->startdate = $startdate;
           $this->enddate = $enddate;
           $this->businesstype = $businesstype;
    }
    public function view(): View
    {
        $start_date = Carbon::parse($this->startdate)
                ->toDateTimeString();
        $end_date = Carbon::parse($this->enddate)
                ->toDateTimeString();
        $companies = Company::where('business_type_id',$this->businesstype)->pluck('id')->toArray();
        $businessplanarray = BusinessPlan::whereIn('company_id',$companies)->pluck('id')->toArray();
        $minitbparray = MiniTBP::whereIn('business_plan_id',$businessplanarray)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->whereBetween('created_at', [$this->startdate, $this->enddate])->orderBy('id','desc')->get();
        return view('dashboard.admin.realtimereport.project.download', [
            'fulltbps' => $fulltbps
        ]);
    }
}
