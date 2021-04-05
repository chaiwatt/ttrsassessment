<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ExpertDetail;
use App\Model\ProjectGrade;
use App\Helper\GetEvPercent;
use App\Model\OfficerDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByIndustryGroupFirstSheet implements 
                                        ShouldAutoSize, 
                                        WithTitle, 
                                        FromArray,
                                        WithHeadings,
                                        WithEvents
{

    protected $projectname;
    protected $years;
    function __construct($_years) {
           $this->projectname = 'จำนวนโครงการตามกลุ่มอุตสาหกรรม';
           $this->years = $_years;
    }

    public function array(): array
    {
        $projectindustrys = Array();
        foreach ($this->years as $key => $year) {
            $projectindustry = Array();
            $businessplans = BusinessPlan::where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->get();
            $automotivearr = Company::where('industry_group_id',1)->pluck('id')->toArray();
            $automotive = BusinessPlan::whereIn('company_id',$automotivearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $smartelectronicarr = Company::where('industry_group_id',2)->pluck('id')->toArray();
            $smartelectronic = BusinessPlan::whereIn('company_id',$smartelectronicarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $affluentarr = Company::where('industry_group_id',3)->pluck('id')->toArray();
            $affluent = BusinessPlan::whereIn('company_id',$affluentarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $agriculturearr = Company::where('industry_group_id',4)->pluck('id')->toArray();
            $agriculture = BusinessPlan::whereIn('company_id',$agriculturearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $foodarr = Company::where('industry_group_id',5)->pluck('id')->toArray();
            $food = BusinessPlan::whereIn('company_id',$foodarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $roboticarr = Company::where('industry_group_id',6)->pluck('id')->toArray();
            $robotic = BusinessPlan::whereIn('company_id',$roboticarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $aviationarr = Company::where('industry_group_id',7)->pluck('id')->toArray();
            $aviation = BusinessPlan::whereIn('company_id',$aviationarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $biofuelarr = Company::where('industry_group_id',8)->pluck('id')->toArray();
            $biofuel = BusinessPlan::whereIn('company_id',$biofuelarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $digitalarr = Company::where('industry_group_id',9)->pluck('id')->toArray();
            $digital = BusinessPlan::whereIn('company_id',$digitalarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $medicalarr = Company::where('industry_group_id',10)->pluck('id')->toArray();
            $medical = BusinessPlan::whereIn('company_id',$medicalarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $defensearr = Company::where('industry_group_id',11)->pluck('id')->toArray();
            $defense = BusinessPlan::whereIn('company_id',$defensearr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $educationarr = Company::where('industry_group_id',12)->pluck('id')->toArray();
            $education = BusinessPlan::whereIn('company_id',$educationarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();
            $otherarr = Company::where('industry_group_id',13)->pluck('id')->toArray();
            $other = BusinessPlan::whereIn('company_id',$otherarr)->where('business_plan_status_id','>=',2)->whereYear('created_at', $year)->count();

            if($automotive != 0 || $smartelectronic != 0 || $affluent != 0 || $agriculture != 0 || $food != 0 || $robotic != 0 || $aviation != 0 || $biofuel != 0 || $digital != 0 || $medical != 0 || $defense != 0 || $education != 0 || $other != 0){
            $projectindustry = array("year" => $year+543,"automotive" => $automotive, "smartelectronic" => $smartelectronic,"affluent" => $affluent,"agriculture" => $agriculture, "food" => $food,"robotic" => $robotic,"aviation" => $aviation, "biofuel" => $biofuel,"digital" => $digital,"medical" => $medical,"defense" => $defense,"education" => $education,"other" => $other);
            array_push($projectindustrys,$projectindustry);
            }
        }
       return [
            $projectindustrys 
        ];
    }

    public function title(): string
    {
        return $this->projectname;
    }
    public function headings(): array
    {
        return [
            'ปีโครงการ',
            'Next-generation Automotive',
            'Smart Electronics',
            'Affluent, Medical and Wellness Tourism',
            'Agriculture and Biotechnology',
            'Food for the Future',
            'Robotics',
            'Aviation and Logistics',
            'Biofuels and Biochemicals',
            'Digital',
            'Medical Hub',
            'Defense',
            'Education and Skill Development',
            'อื่นๆ'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:N1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    // 'fill' => [
                    //     'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    //     'color' => ['argb' => 'FFFF0000'],
                    // ]
                ]);
            }
        ];
    }
}
