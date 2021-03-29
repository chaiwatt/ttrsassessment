<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Scoring;
use App\Model\BusinessPlan;
use App\Model\OfficerDetail;
use App\Model\CriteriaTransaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportProjectExportByIndustryGroupMultipleSheet implements 
                                        FromArray,
                                        ShouldAutoSize, 
                                        WithTitle, 
                                        WithHeadings,
                                        WithEvents
{
    protected $year;
    protected $projectname;
    protected $userid;

    function __construct($year) {
           $this->year = $year;
           $this->projectname = $year + 543;
    }

    public function array(): array
    {
        $projectindustrys = Array();
        $businesspalns = BusinessPlan::whereYear('created_at',$this->year)->get();
        foreach ($businesspalns as $key => $businesspaln) {
            $projectindustry = Array();
            array_push($projectindustry,@$businesspaln->minitbp->project);

            if(@$businesspaln->company->industry_group_id == 1){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 2){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 3){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 4){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 5){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 6){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 7){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 8){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 9){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 10){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 11){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 12){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }
            if(@$businesspaln->company->industry_group_id == 13){
                array_push($projectindustry,'y');
            }else{
                array_push($projectindustry,'');
            }

            array_push($projectindustrys,$projectindustry);
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
            'โครงการ',
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
            'อื่น ๆ'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:D1')->applyFromArray([
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
