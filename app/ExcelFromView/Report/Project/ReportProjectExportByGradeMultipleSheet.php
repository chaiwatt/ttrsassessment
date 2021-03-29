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

class ReportProjectExportByGradeMultipleSheet implements 
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
        $projectingrades = Array();
        $businesspalns = BusinessPlan::whereYear('created_at',$this->year)->get();
        foreach ($businesspalns as $key => $businesspaln) {
            $singleproject = Array();
            array_push($singleproject,@$businesspaln->minitbp->project);

            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'AAA'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'AA'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'A'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'BBB'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'BB'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'B'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'CCC'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'CC'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'C'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }
            if(@$businesspaln->minitbp->fulltbp->projectgrade->grade == 'D'){
                array_push($singleproject,'y');
            }else{
                array_push($singleproject,'');
            }

            array_push($projectingrades,$singleproject);
        }
       return [
            $projectingrades 
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
            'เกรด AAA',
            'เกรด AA',
            'เกรด A',
            'เกรด BBB',
            'เกรด BB',
            'เกรด B',
            'เกรด CCC',
            'เกรด CC',
            'เกรด C',
            'เกรด D'
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
