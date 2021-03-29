<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\ExpertDetail;
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

class ReportNumprojectExportFirstSheet implements 
                                        ShouldAutoSize, 
                                        WithTitle, 
                                        FromArray,
                                        WithHeadings,
                                        WithEvents
{

    protected $projectname;
    protected $years;
    function __construct($_years) {
           $this->projectname = 'จำนวนโครงการ';
           $this->years = $_years;
    }

    public function array(): array
    {
        $projectinfos = Array();
        foreach ($this->years as $key => $year) {
            $singleproject = Array();
            $minitpbs = BusinessPlan::whereYear('created_at',$year)->where('business_plan_status_id','>=',4)->count();
            $fulltbps = BusinessPlan::whereYear('created_at',$year)->where('business_plan_status_id','>=',6)->count();
            $finished = BusinessPlan::whereYear('created_at',$year)->where('business_plan_status_id','>=',8)->count();
            array_push($singleproject,($year+543));
            array_push($singleproject,$minitpbs);
            array_push($singleproject,$fulltbps);
            array_push($singleproject,$finished);
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
            'ปีโครงการ',
            'จำนวน Mini TBP',
            'จำนวน Full TBP',
            'ประเมินสำเร็จ',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:C1')->applyFromArray([
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
