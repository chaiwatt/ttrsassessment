<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
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

class ReportTTRSSingleOfficerExportFirstSheet implements 
                                        ShouldAutoSize, 
                                        WithTitle, 
                                        FromArray,
                                        WithHeadings,
                                        WithEvents
{
    protected $officerid;
    protected $projectname;

    function __construct($officerid) {
           $this->officerid = $officerid;
           $this->projectname = 'Over All';
    }

    public function array(): array
    {
        $officerinfos = Array();
        $officer = OfficerDetail::find($this->officerid);
       !Empty($officer->expereinceyear) ? $expereinceyear = $officer->expereinceyear : $expereinceyear = 0;
       !Empty($officer->expereincemonth) ? $expereincemonth = $officer->expereincemonth : $expereincemonth = 0;
       $_expertfield ='';
       if($officer->expertfield->count() > 0){
            foreach ($officer->expertfield as $key => $expertfield) {
                $_expertfield .= ' อันดับที่ ' . ($key + 1) . ' ' . $expertfield->detail ;
            }
       }
       
       $user = $officer->user;
       $projectmemberbelongeds = $officer->projectmember($user->id);
       $userprefix = $user->prefix->name;
       if($userprefix == 'อื่นๆ'){
        $userprefix = $user->alter_prefix;
       }
       array_push($officerinfos, $userprefix.$user->name . ' ' . $user->lastname);
       array_push($officerinfos, $user->address . ' ตำบล'. $user->province($user->province_id) . ' อำเภอ'. $user->amphur($user->amphur_id) . ' จังหวัด' . $user->tambol($user->tambol_id) . ' รหัสไปรษณีย์ ' . $user->postal);
       array_push($officerinfos, $user->address1 . ' ตำบล'. $user->province($user->province1_id) . ' อำเภอ'. $user->amphur($user->amphur1_id) . ' จังหวัด' . $user->tambol($user->tambol1_id) . ' รหัสไปรษณีย์ ' . $user->postal1);
       array_push($officerinfos, $user->phone);
       array_push($officerinfos, $user->email);
       array_push($officerinfos, $officer->position);
       array_push($officerinfos, $officer->organization);
       array_push($officerinfos, $officer->educationlevel->name);
       array_push($officerinfos, $expereinceyear . ' ปี ' . $expereincemonth . ' เดือน');
       array_push($officerinfos, $officer->expertbranch->name);
       array_push($officerinfos, $_expertfield);
       array_push($officerinfos, $projectmemberbelongeds->count());
       array_push($officerinfos, number_format(GetEvPercent::getEvOverAveragePercent($officer->user_id), 2) .' %');
       array_push($officerinfos, number_format(GetEvPercent::getEvOverAveragePercentByPillar($officer->user_id,1), 2) .' %');
       array_push($officerinfos, number_format(GetEvPercent::getEvOverAveragePercentByPillar($officer->user_id,2), 2) .' %');
       array_push($officerinfos, number_format(GetEvPercent::getEvOverAveragePercentByPillar($officer->user_id,3), 2) .' %');
       array_push($officerinfos, number_format(GetEvPercent::getEvOverAveragePercentByPillar($officer->user_id,4), 2) .' %');
    
       return [
            $officerinfos 
        ];
    }

    public function title(): string
    {
        return $this->projectname;
    }
    public function headings(): array
    {
        return [
            'ชื่อ-นามสกุล',
            'ที่อยู่ตามบัตรประจำตัวประชาชน',
            'ที่อยู่ที่ติดต่อได้',
            'โทรศัพท์',
            'อีเมล',
            'หน่วยงานที่สังกัด',
            'ตำแหน่ง',
            'วุฒิการศึกษาสูงสุด',
            'ประสบการณ์การทำงาน',
            'สาขาความเชี่ยวชาญ',
            'ระดับความเชี่ยวชาญ',
            'จำนวนโครงการที่รับผิดชอบ',
            'ความแม่นยำการประเมินโดยรวม',
            'ความแม่นยำการประเมินด้านการบริหารจัดการ',
            'ความแม่นยำการประเมินด้านเทคโนโลยีและนวัตกรรม',
            'ความแม่นยำการประเมินความสามารถด้านการตลาด',
            'ความแม่นยำการประเมินด้านความเป็นไปได้ทางธุรกิจ'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:Q1')->applyFromArray([
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
