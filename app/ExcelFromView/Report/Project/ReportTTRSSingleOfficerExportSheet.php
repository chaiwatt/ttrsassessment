<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\OfficerDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportTTRSSingleOfficerExportSheet implements 
                                        FromQuery,
                                        ShouldAutoSize, 
                                        WithTitle, 
                                        WithMapping, 
                                        WithHeadings,
                                        WithEvents
{
    protected $fulltbpid;
    protected $projectname;

    function __construct($fulltbpid) {
           $minitbp = MiniTBP::find(FullTbp::find($fulltbpid)->mini_tbp_id)->first();
           $this->fulltbpid = $fulltbpid;
           $this->projectname = $minitbp->project;
    }

    public function query()
    {
        $fulltbp = FullTbp::query()->first();
        return $fulltbp;

        // return Invoice
        //     ::query()
        //     ->whereYear('created_at', $this->year)
        //     ->whereMonth('created_at', $this->month);
    }

    public function map($fulltbp): array
    {
        return [
            $fulltbp->id,
            $fulltbp->fulltbp_code,
            $fulltbp->minitbp->project
        ];
    }
    public function title(): string
    {
        return $this->projectname;
    }
    public function headings(): array
    {
        return [
            '#',
            'Full TBP code',
            'Project'
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
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FFFF0000'],
                    ]
                ]);
            }
        ];
    }
}
