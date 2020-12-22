<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Isic;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Model\Company;
use App\Model\IsicSub;
use App\Model\Province;
use App\Model\UserPosition;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Model\CompanyAddress;
use App\Model\FullTbpCompanyDoc;
use App\Model\AuthorizedDirector;

class DashboardAdminSearchCompanyProfileController extends Controller
{
    public function Index($id){
        $company = Company::find($id);
        $user = User::find($company->user_id);
        $companyaddress = CompanyAddress::where('company_id',$company->id)->first();
        $prefixes = Prefix::get();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$companyaddress->province_id)->get();
        $tambols = Tambol::where('amphur_id',$companyaddress->amphur_id)->get();
        $isics = Isic::get();
        $isicsubs = IsicSub::where('isic_id',$company->isic_id)->get();
        $industrygroups = IndustryGroup::get();
        $fulltbpcompanydocs = FullTbpCompanyDoc::where('company_id',$company->id)->get();
        $userpositions = UserPosition::get();
        $authorizeddirectors = AuthorizedDirector::where('company_id',$company->id)->get();
        return view('dashboard.admin.search.company.profile.view')->withUser($user)
                                            ->withPrefixes($prefixes)
                                            ->withProvinces($provinces)
                                            ->withAmphurs($amphurs)
                                            ->withTambols($tambols)
                                            ->withIsics($isics)
                                            ->withCompany($company)
                                            ->withIsicsubs($isicsubs)
                                            ->withIndustrygroups($industrygroups)
                                            ->withFulltbpcompanydocs($fulltbpcompanydocs)
                                            ->withAuthorizeddirectors($authorizeddirectors)
                                            ->withUserpositions($userpositions);
    }
}
