<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Model\Province;
use App\Model\ExpertDoc;
use App\Model\ExpertField;
use App\Model\ExpertBranch;
use App\Model\ExpertDetail;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;
use App\Model\EducationLevel;

class DashboardAdminSearchOfficerProfileController extends Controller
{
    public function Index($id){
   
        $user = User::find($id);
        $prefixes = Prefix::get();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$user->province_id)->get();
        $tambols = Tambol::where('amphur_id',$user->amphur_id)->get();
        $amphurs1 = Amphur::where('province_id',$user->province1_id)->get();
        $tambols1 = Tambol::where('amphur_id',$user->amphur1_id)->get();
        $officerbanches = ExpertBranch::get();
        $educationlevels = EducationLevel::get();
        $officer = OfficerDetail::where('user_id',$id)->first();
        $officerfields = ExpertField::where('user_id',$user->id)->get();
        $officerdocs = ExpertDoc::where('user_id',$user->id)->get();
        
        return view('dashboard.admin.search.officer.profile.view')->withUser($user)
                                            ->withPrefixes($prefixes)
                                            ->withProvinces($provinces)
                                            ->withAmphurs($amphurs)
                                            ->withTambols($tambols)
                                            ->withAmphurs1($amphurs1)
                                            ->withTambols1($tambols1)
                                            ->withOfficerbanches($officerbanches)
                                            ->withEducationlevels($educationlevels)
                                            ->withOfficer($officer)
                                            ->withOfficerfields($officerfields)
                                            ->withOfficerdocs($officerdocs);
    }
}
