<?php

namespace App\ExcelFromView\Report\Admin;

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

class ReportProjectObjectiveExport implements 
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
    // $numprojects = Array();
    $objectives = Array();
    $years = BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray();
    foreach ($years as $key => $year) {
        $financeojective = MiniTBP::where('minitbp_objecttive',1)->whereYear('created_at', $year)->count();
        $nonefinanceojective = MiniTBP::where('minitbp_objecttive',2)->whereYear('created_at', $year)->count();
        $bothojective = MiniTBP::where('minitbp_objecttive',3)->whereYear('created_at', $year)->count();

        $objectives = array("year" => $year+543,"finance" => $financeojective, "nonfinance" => $nonefinanceojective,"bothobjecttive" => $bothojective);

    }
       return [
            $objectives 
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
                ]);
            }
        ];
    }
}
