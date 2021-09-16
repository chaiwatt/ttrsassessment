<?php

namespace App\ExcelFromView\Report\Project;

use App\User;
use Carbon\Carbon;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\ExpertDetail;
use App\Model\OfficerDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExpertExport implements FromView,ShouldAutoSize, WithTitle
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
            $officerdetailarr1 = ExpertDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            $officerdetailarruniques = array_unique($officerdetailarr1);
            $experts = ExpertDetail::whereIn('id',$officerdetailarruniques)->get();
        }elseif (!Empty($this->search) && $this->expertbranch != 0  && $this->educationlevel == 0){
            $userarray = User::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            $officerdetailarr1 = ExpertDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            $officerdetailarruniques = array_unique($officerdetailarr1);
            $experts = ExpertDetail::whereIn('id',$officerdetailarruniques)->where('expert_branch_id',$this->expertbranch)->get();
        }elseif (!Empty($this->search) && $this->expertbranch == 0  && $this->educationlevel != 0){
            $userarray = User::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            $officerdetailarr1 = ExpertDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            $officerdetailarruniques = array_unique($officerdetailarr1);
            $experts = ExpertDetail::whereIn('id',$officerdetailarruniques)->where('education_level_id',$this->educationlevel)->get();
        }elseif (Empty($this->search) && $this->expertbranch != 0  && $this->educationlevel == 0){
            $experts = ExpertDetail::where('expert_branch_id',$this->expertbranch)->get();
        }elseif (Empty($this->search) && $this->expertbranch != 0  && $this->educationlevel != 0){
            $experts = ExpertDetail::where('expert_branch_id',$this->expertbranch)->where('education_level_id',$this->educationlevel)->get();
        }elseif (Empty($this->search) && $this->expertbranch == 0  && $this->educationlevel != 0){
            $experts = ExpertDetail::where('education_level_id',$this->educationlevel)->get();
        }elseif (!Empty($this->search) && $this->expertbranch != 0  && $this->educationlevel != 0){
            $userarray = User::where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('lastname', 'like', '%' . $this->search . '%')->pluck('id')->toArray();
            $officerdetailarr1 = ExpertDetail::whereIn('user_id',$userarray)->pluck('id')->toArray();
            $officerdetailarruniques = array_unique($officerdetailarr1);
            $experts = ExpertDetail::whereIn('id',$officerdetailarruniques)->where('expert_branch_id',$this->expertbranch)->where('education_level_id',$this->educationlevel)->get();
        }else{
            $experts = ExpertDetail::get();
        }

        return view('dashboard.admin.realtimereport.expert.download', [
            'experts' => $experts
        ]);
    }
}
