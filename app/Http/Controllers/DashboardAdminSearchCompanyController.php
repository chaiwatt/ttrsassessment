<?php

namespace App\Http\Controllers;

use App\Model\Isic;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Model\RegisteredCapitalType;

class DashboardAdminSearchCompanyController extends Controller
{
    public function Index(){
        $fulltbbs = FullTbp::get();
        $industrygroups = IndustryGroup::get();
        $isics = Isic::get();
        $registeredcapitals = RegisteredCapitalType::get();
        // $minitbps = MiniTBP::get();
        // return $minitbps;
        return view('dashboard.admin.search.company.index')->withFulltbps($fulltbbs)
                                                        ->withIndustrygroups($industrygroups)
                                                        ->withIsics($isics)
                                                        ->withRegisteredcapitals($registeredcapitals);
    }
}
