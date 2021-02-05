<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\OfficerDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportTTRSOfficerExport implements FromView,ShouldAutoSize, WithTitle
{
    protected $search;

    function __construct($search) {
           $this->search = $search;
    }
    public function title(): string
    {
        return 'OverAll';
    }
    public function view(): View
    {
        $userarray = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
                
        $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();

        $officerdetailarr2 = OfficerDetail::where('position', 'like', '%' . $this->search . '%')
                ->orWhere('organization', 'like', '%' . $this->search . '%')->pluck('id')->toArray();

        $officerdetailarruniques = array_unique(array_merge($officerdetailarr1,$officerdetailarr2));
        $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->get();

        return view('dashboard.admin.realtimereport.ttrsofficer.download', [
            'officers' => $officers
        ]);
    }
}
