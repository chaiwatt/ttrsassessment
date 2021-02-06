<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\Scoring;
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

class ReportTTRSSingleOfficerExportSheet implements 
                                        // FromQuery,
                                        FromArray,
                                        ShouldAutoSize, 
                                        WithTitle, 
                                        // WithMapping, 
                                        WithHeadings,
                                        WithEvents
{
    protected $fulltbpid;
    protected $projectname;
    protected $userid;

    function __construct($fulltbpid,$userid) {
           $minitbp = MiniTBP::find(FullTbp::find($fulltbpid)->mini_tbp_id);
           $this->fulltbpid = $fulltbpid;
           $this->userid = $userid;
           $this->projectname = $minitbp->project;
    }

    public function array(): array
    {
        $scoreinfo = Array();
        $temparr = Array();
        $ev= Ev::where('full_tbp_id',$this->fulltbpid)->first();
        $criteriatransactions = CriteriaTransaction::query()->where('ev_id',$ev->id)->get();
        foreach ($criteriatransactions as $key => $criteriatransaction) {
            $criteriainfo = Array();
            $criteriatransaction_pillar_name = '';
            $criteriatransaction_subpillar_name = '';
            $criteriatransaction_subpillarindex_name = '';
            $criterianame = $criteriatransaction->subpillarindex->name . ' (เกรด)';
            if(!Empty($criteriatransaction->criteria->name)){
                $criterianame = $criteriatransaction->criteria->name;
            }
            $temp = $criteriatransaction->pillar_id .'-'. $criteriatransaction->sub_pillar_id .'-'. $criteriatransaction->sub_pillar_index_id;
            if (Empty(array_search($temp,$temparr))){
                array_push($temparr, $temp);
                $criteriatransaction_pillar_name = $criteriatransaction->pillar->name;
                $criteriatransaction_subpillar_name = $criteriatransaction->subpillar->name;
                $criteriatransaction_subpillarindex_name = $criteriatransaction->subpillarindex->name;
            }
          
            array_push($criteriainfo, $criteriatransaction_pillar_name);
            array_push($criteriainfo, $criteriatransaction_subpillar_name);
            array_push($criteriainfo, $criteriatransaction_subpillarindex_name);
            array_push($criteriainfo, $criterianame);
            
            $userscore = Scoring::where('criteria_transaction_id',$criteriatransaction->id)->where('user_id',$this->userid)->first();
            if(!Empty($userscore)){
                if($userscore->scoretype == 1){
                    array_push($criteriainfo, '');
                    array_push($criteriainfo, $userscore->score);
                    
                }else if($userscore->scoretype == 2){
                    array_push($criteriainfo, '1');
                    array_push($criteriainfo, '');
                   
                }
            }else{
                array_push($criteriainfo, '0');
                array_push($criteriainfo, '');
            }
            $finalscore = Scoring::where('criteria_transaction_id',$criteriatransaction->id)->whereNull('user_id')->first();
            if(!Empty($finalscore)){
                if($finalscore->scoretype == 1){
                    array_push($criteriainfo, '');
                    array_push($criteriainfo, $finalscore->score);
                    
                }else if($finalscore->scoretype == 2){
                    array_push($criteriainfo, '1');
                    array_push($criteriainfo, '');
                }
            }else{
                array_push($criteriainfo, '0');
                array_push($criteriainfo, '');
            }
            array_push($scoreinfo, $criteriainfo);
        }

    
       return [
            $scoreinfo 
        ];
    }

    public function title(): string
    {
        return $this->projectname;
    }
    public function headings(): array
    {
        return [
            'Pillar',
            'Sub Pillar',
            'Index',
            'Criteria',
            'ตัวเลือก',
            'เกรด',
            'สรุปตัวเลือก',
            'สรุปเกรด',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:H1')->applyFromArray([
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
