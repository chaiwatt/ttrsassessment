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
    protected $expertbranch;
    protected $educationlevel;

    function __construct($search,$expertbranch,$educationlevel) {
           $this->search = $search;
           $this->expertbranch = $expertbranch;
           $this->educationlevel = $educationlevel;
    }
    public function title(): string
    {
        return 'OverAll';
    }
    public function view(): View
    {
        if(!Empty($this->search) && $this->expertbranch == 0  && $this->educationlevel == 0){
            $userarray = User::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            $officerdetailarruniques = array_unique($officerdetailarr1);
            $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->get();
        }elseif (!Empty($this->search) && $this->expertbranch != 0  && $this->educationlevel == 0){
            $userarray = User::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            $officerdetailarruniques = array_unique($officerdetailarr1);
            $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->where('officer_branch_id',$this->expertbranch)->get();
        }elseif (!Empty($this->search) && $this->expertbranch == 0  && $this->educationlevel != 0){
            $userarray = User::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            $officerdetailarruniques = array_unique($officerdetailarr1);
            $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->where('education_level_id',$this->educationlevel)->get();
        }elseif (Empty($this->search) && $this->expertbranch != 0  && $this->educationlevel == 0){
            $officers = OfficerDetail::where('officer_branch_id',$this->expertbranch)->get();
        }elseif (Empty($this->search) && $this->expertbranch != 0  && $this->educationlevel != 0){
            $officers = OfficerDetail::where('officer_branch_id',$this->expertbranch)->where('education_level_id',$this->educationlevel)->get();
        }elseif (Empty($this->search) && $this->expertbranch == 0  && $this->educationlevel != 0){
            $officers = OfficerDetail::where('education_level_id',$this->educationlevel)->get();
        }elseif (!Empty($this->search) && $this->expertbranch != 0  && $this->educationlevel != 0){
            $userarray = User::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            $officerdetailarruniques = array_unique($officerdetailarr1);
            $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->where('officer_branch_id',$this->expertbranch)->where('education_level_id',$this->educationlevel)->get();
        }else{
            $officers = OfficerDetail::get();
        }

        // $userarray = User::where('name', 'like', '%' . $this->search . '%')
        //         ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
                
        // $officerdetailarr1 = OfficerDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();

        // $officerdetailarr2 = OfficerDetail::where('position', 'like', '%' . $this->search . '%')
        //         ->orWhere('organization', 'like', '%' . $this->search . '%')->pluck('id')->toArray();

        // $officerdetailarruniques = array_unique(array_merge($officerdetailarr1,$officerdetailarr2));
        // $officers = OfficerDetail::whereIn('id',$officerdetailarruniques)->get();

        return view('dashboard.admin.realtimereport.ttrsofficer.download', [
            'officers' => $officers
        ]);
    }
}
