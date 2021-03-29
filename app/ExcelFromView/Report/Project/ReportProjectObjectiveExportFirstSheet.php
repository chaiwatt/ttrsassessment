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

class ReportProjectObjectiveExportFirstSheet implements 
                                        ShouldAutoSize, 
                                        WithTitle, 
                                        FromArray,
                                        WithHeadings,
                                        WithEvents
{

    protected $projectname;
    protected $years;
    function __construct($_years) {
           $this->projectname = 'จำนวนโครงการตามจุดมุ่งหมาย';
           $this->years = $_years;
    }

    public function array(): array
    {
        $projectobjecttives = Array();
        foreach ($this->years as $key => $year) {
            $projectobjecttive = Array();
            $financeojective = MiniTBP::where('minitbp_objecttive',1)->whereYear('created_at', $year)->count();
            $nonefinanceojective = MiniTBP::where('minitbp_objecttive',2)->whereYear('created_at', $year)->count();
            $bothojective = MiniTBP::where('minitbp_objecttive',3)->whereYear('created_at', $year)->count();
            $projectobjecttive = array("year" => $year+543,"finance" => $financeojective, "nonfinance" => $nonefinanceojective,"bothobjecttive" => $bothojective);
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
