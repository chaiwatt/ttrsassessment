<?php

namespace App\ExcelFromView\Report\Admin;

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

class ReportNumprojectExport implements 
                                        ShouldAutoSize, 
                                        WithTitle, 
                                        FromArray,
                                        WithHeadings,
                                        WithEvents
{
    protected $projectname;

    function __construct() {
           $this->projectname = 'จำนวนโครงการ';
    }

    public function array(): array
    {
       $numprojects = Array();
       $years = BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray();
       foreach ($years as $key => $year) {
            $projecteachyear = Array();
            $minitpbs = BusinessPlan::where('business_plan_status_id','>=',4)->count();
            $fulltbps = BusinessPlan::where('business_plan_status_id','>=',6)->count();
            $finished = BusinessPlan::where('business_plan_status_id','>=',8)->count();
            array_push($projecteachyear,($year+543));
            array_push($projecteachyear,$minitpbs);
            array_push($projecteachyear,$fulltbps);
            array_push($projecteachyear,$finished);
            array_push($numprojects,$projecteachyear);
       }
       return [
            $numprojects 
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
            'ประเมินสำเร็จ'
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
                ]);
            }
        ];
    }
}
