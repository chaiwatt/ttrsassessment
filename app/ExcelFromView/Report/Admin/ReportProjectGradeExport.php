<?php

namespace App\ExcelFromView\Report\Admin;

use App\User;
use Carbon\Carbon;
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

class ReportProjectGradeExport implements 
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
    $projectgrades = Array();
    $years = BusinessPlan::latest()->get()->map(function($user){ return $user['created_at']->year; })->unique()->sort()->toArray();
    foreach ($years as $key => $year) {
         $projecteachyear = Array();
         $projectgrade = Array();
         $minitpbcounts = BusinessPlan::where('business_plan_status_id','>=',4)->whereYear('created_at', $year)->count();
         $fulltbpcounts = BusinessPlan::where('business_plan_status_id','>=',6)->whereYear('created_at', $year)->count();
         $finishecountd = BusinessPlan::where('business_plan_status_id','>=',8)->whereYear('created_at', $year)->count();
         $projecteachyear = array("year" => $year+543,"minitpbs" => $minitpbcounts, "fulltbps" => $fulltbpcounts,"finished" => $finishecountd);
         array_push($numprojects,$projecteachyear);

         $aaa = ProjectGrade::where('grade','AAA')->whereYear('created_at', $year)->count();
         $aa = ProjectGrade::where('grade','AA')->whereYear('created_at', $year)->count();
         $a = ProjectGrade::where('grade','A')->whereYear('created_at', $year)->count();
         $bbb = ProjectGrade::where('grade','BBB')->whereYear('created_at', $year)->count();
         $bb = ProjectGrade::where('grade','BB')->whereYear('created_at', $year)->count();
         $b = ProjectGrade::where('grade','B')->whereYear('created_at', $year)->count();
         $ccc = ProjectGrade::where('grade','CCC')->whereYear('created_at', $year)->count();
         $cc = ProjectGrade::where('grade','CC')->whereYear('created_at', $year)->count();
         $c = ProjectGrade::where('grade','C')->whereYear('created_at', $year)->count();
         $d = ProjectGrade::where('grade','D')->whereYear('created_at', $year)->count();

         $projectgrade = array("year" => $year+543,"AAA" => $aaa, "AA" => $aa,"A" => $a,"BBB" => $bbb, "BB" => $bb,"B" => $b,"CCC" => $ccc, "CC" => $cc,"C" => $c,"D" => $d);
         array_push($projectgrades,$projectgrade);

    }
       return [
            $projectgrades 
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
                $event->sheet->getStyle('A1:K1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                ]);
            }
        ];
    }
}
