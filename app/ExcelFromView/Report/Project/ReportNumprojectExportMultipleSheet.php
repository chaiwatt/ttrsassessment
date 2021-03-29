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

class ReportNumprojectExportMultipleSheet implements 
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
        $projectinfos = Array();
        $businesspalns = BusinessPlan::whereYear('created_at',$this->year)->get();
        foreach ($businesspalns as $key => $businesspaln) {
            $singleproject = Array();
            array_push($singleproject,$businesspaln->minitbp->project);
            if($businesspaln->business_plan_status_id >= 4){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if($businesspaln->business_plan_status_id >= 6){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if($businesspaln->business_plan_status_id >= 8){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            array_push($projectinfos,$singleproject);
        }
       return [
            $projectinfos 
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
            'Mini TBP',
            'Full TBP',
            'ประเมินสำเร็จ',
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
