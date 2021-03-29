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

class ReportProjectObjectiveExportMultipleSheet implements 
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
        $projectobjecttives = Array();
        $businesspalns = BusinessPlan::whereYear('created_at',$this->year)->get();
        foreach ($businesspalns as $key => $businesspaln) {
            $projectobjecttive = Array();
            array_push($projectobjecttive,@$businesspaln->minitbp->project);

            if(@$businesspaln->minitbp->minitbp_objecttive == 1){
                array_push($projectobjecttive,'y');
            }else{
                array_push($projectobjecttive,'');
            }
            if(@$businesspaln->minitbp->minitbp_objecttive == 2){
                array_push($projectobjecttive,'y');
            }else{
                array_push($projectobjecttive,'');
            }
            if(@$businesspaln->minitbp->minitbp_objecttive == 3){
                array_push($projectobjecttive,'y');
            }else{
                array_push($projectobjecttive,'');
            }
            array_push($projectobjecttives,$projectobjecttive);
        }
       return [
            $projectobjecttives 
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
            'ด้านการเงิน',
            'ไม่ใช่ด้านการเงิน',
            'ด้านการเงินและไม่ใช่ด้านการเงิน'
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
