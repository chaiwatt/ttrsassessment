<?php

namespace App\Http\Controllers;

use App\Model\Prefix;
use App\Model\Company;
use App\Model\MiniTBP;
use App\Model\FullTbp;
use App\Helper\EmailBox;
use App\Model\FullTbpCost;
use App\Model\FullTbpSell;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\CompanyBoard;
use App\Model\FullTbpAsset;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use App\Model\CriteriaGroup;
use Illuminate\Http\Request;
use App\Model\EmployPosition;
use App\Model\EmployTraining;
use App\Model\EmployEducation;
use App\Model\FullTbpEmployee;
use App\Model\EmployExperience;
use App\Model\ExpertAssignment;
use App\Model\FullTbpCompanyDoc;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpMarketNeed;
use App\Model\FullTbpMarketSize;
use App\Model\FullTbpSellStatus;
use App\Model\ProjectAssignment;
use App\Model\CompanyStockHolder;
use App\Model\FullTbpDebtPartner;
use App\Model\FullTbpMarketShare;
use App\Model\FullTbpProjectPlan;
use App\Model\FullTbpCreditPartner;
use App\Model\FullTbpProductDetail;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectCertify;
use App\Model\FullTbpProjectTechDev;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpProjectStandard;
use App\Model\FullTbpMarketAttachment;
use App\Model\FullTbpMainProductDetail;
use App\Model\FullTbpMarketCompetitive;
use App\Model\FullTbpReturnOfInvestment;
use App\Model\FullTbpProjectTechDevLevel;
use App\Model\FullTbpCompanyProfileDetail;
use App\Model\FullTbpProjectAbtractDetail;
use App\Model\FullTbpProjectTechDevProblem;
use App\Model\FullTbpProjectAwardAttachment;
use App\Model\FullTbpCompanyProfileAttachment;
use App\Model\FullTbpProjectCertifyAttachment;

class DashboardExpertProjectFullTbpController extends Controller
{
    public function Index(){
        $expertassignments = ExpertAssignment::where('user_id',Auth::user()->id)
                                            ->where('expert_assignment_status_id',2)
                                            ->pluck('full_tbp_id')->toArray();
        $fulltbps = FullTbp::whereIn('id',$expertassignments)->get();
        return view('dashboard.expert.project.fulltbp.index')->withFulltbps($fulltbps) ;
    }
    public function View($id){
        $businesstypes = BusinessType::get();
        $fulltbp = FullTbp::find($id);
        $fulltbpcompanyprofile = FullTbpCompanyProfile::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpemployee = FullTbpEmployee::where('full_tbp_id', $fulltbp->id)->first();
        $fulltbpcompanyprofiledetails = FullTbpCompanyProfileDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpcompanyprofileattachments = FullTbpCompanyProfileAttachment::where('full_tbp_id',$fulltbp->id)->get();
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $company = Company::find(BusinessPlan::find($minitbp->business_plan_id)->company_id);
        $prefixes = Prefix::get();
        $employpositions = EmployPosition::get();
        $companyemploys = CompanyEmploy::where('company_id',$company->id)->get();
        $companystockholders = CompanyStockHolder::where('company_id',$company->id)->get();
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        $fulltbpprojectabtractdetails = FullTbpProjectAbtractDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpMainproductdetails = FullTbpMainProductDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpproductdetails = FullTbpProductDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevs = FullTbpProjectTechDev::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevlevels = FullTbpProjectTechDevLevel::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevproblems = FullTbpProjectTechDevProblem::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojectcertify = FullTbpProjectCertify::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpprojectcertifyattachments = FullTbpProjectCertifyAttachment::where('project_certify_id',$fulltbpprojectcertify->id)->get();
        $fulltbpprojectawardattachments = FullTbpProjectAwardAttachment::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojectstandards = FullTbpProjectStandard::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojectplans =  FullTbpProjectPlan::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpmarketneeds = FullTbpMarketNeed::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpmarketsizes = FullTbpMarketSize::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpmarketshares = FullTbpMarketShare::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpmarketcompetitives = FullTbpMarketCompetitive::where('full_tbp_id',$fulltbp->id)->get();
        $fullTbpmarketattachmentmodelcanvases = FullTbpMarketAttachment::where('full_tbp_id',$fulltbp->id)->where('attachmenttype',1)->get();
        $fullTbpmarketattachmentswots = FullTbpMarketAttachment::where('full_tbp_id',$fulltbp->id)->where('attachmenttype',2)->get();
        $fullTbpmarketattachmentfinancialplans = FullTbpMarketAttachment::where('full_tbp_id',$fulltbp->id)->where('attachmenttype',3)->get();
        $fulltbpsells = FullTbpSell::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpsellstatuses = FullTbpSellStatus::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpdebtpartners = FullTbpDebtPartner::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpcreditpartners = FullTbpCreditPartner::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpassets = FullTbpAsset::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpinvestments = FullTbpInvestment::where('full_tbp_id',$fulltbp->id)->get();        
        $fulltbpcosts = FullTbpCost::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpreturnofinvestment = FullTbpReturnOfInvestment::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpcompanydocs = FullTbpCompanyDoc::where('full_tbp_id',$fulltbp->id)->get();
        return view('dashboard.admin.project.fulltbp.view')->withFulltbp($fulltbp)
                                                ->withFulltbpemployee($fulltbpemployee)
                                                ->withBusinesstypes($businesstypes)
                                                ->withFulltbpcompanyprofile($fulltbpcompanyprofile)
                                                ->withFulltbpcompanyprofiledetails($fulltbpcompanyprofiledetails)
                                                ->withFulltbpcompanyprofileattachments($fulltbpcompanyprofileattachments)
                                                ->withCompanyemploys($companyemploys)
                                                ->withPrefixes($prefixes)
                                                ->withEmploypositions($employpositions)
                                                ->withCompanystockholders($companystockholders)
                                                ->withCompany($company)
                                                ->withMinitbp($minitbp)
                                                ->withContactprefixes($contactprefixes)
                                                ->withContactpositions($contactpositions)
                                                ->withFulltbpprojectabtractdetails($fulltbpprojectabtractdetails)
                                                ->withFulltbpMainproductdetails($fulltbpMainproductdetails)
                                                ->withFulltbpproductdetails($fulltbpproductdetails)
                                                ->withFulltbpprojecttechdevs($fulltbpprojecttechdevs)
                                                ->withFulltbpprojecttechdevlevels($fulltbpprojecttechdevlevels)
                                                ->withFulltbpprojecttechdevproblems($fulltbpprojecttechdevproblems)
                                                ->withFulltbpprojectcertify($fulltbpprojectcertify)
                                                ->withFulltbpprojectcertifyattachments($fulltbpprojectcertifyattachments)
                                                ->withFulltbpprojectawardattachments($fulltbpprojectawardattachments)
                                                ->withFulltbpprojectstandards($fulltbpprojectstandards)
                                                ->withFulltbpprojectplans($fulltbpprojectplans)
                                                ->withFulltbpmarketneeds($fulltbpmarketneeds)
                                                ->withFulltbpmarketsizes($fulltbpmarketsizes)
                                                ->withFulltbpmarketshares($fulltbpmarketshares)
                                                ->withFulltbpmarketcompetitives($fulltbpmarketcompetitives)
                                                ->withFullTbpmarketattachmentmodelcanvases($fullTbpmarketattachmentmodelcanvases)
                                                ->withFullTbpmarketattachmentswots($fullTbpmarketattachmentswots)
                                                ->withFullTbpmarketattachmentfinancialplans($fullTbpmarketattachmentfinancialplans)
                                                ->withFulltbpsells($fulltbpsells)
                                                ->withFulltbpsellstatuses($fulltbpsellstatuses)
                                                ->withFulltbpdebtpartners($fulltbpdebtpartners)
                                                ->withFulltbpcreditpartners($fulltbpcreditpartners)
                                                ->withFulltbpassets($fulltbpassets)
                                                ->withFulltbpinvestments($fulltbpinvestments)
                                                ->withFulltbpcosts($fulltbpcosts)
                                                ->withFulltbpreturnofinvestment($fulltbpreturnofinvestment)
                                                ->withFulltbpcompanydocs($fulltbpcompanydocs);
    }
    public function EditAccept(Request $request){
        ExpertAssignment::where('full_tbp_id', $request->id)
                                        ->where('user_id',Auth::user()->id)
                                        ->first()->update([
                                            'accepted' => $request->value
                                        ]);
        $expertassignments = ExpertAssignment::where('full_tbp_id', $request->id)
                                        ->where('user_id',Auth::user()->id)->get();
        return response()->json($expertassignments); 
    }
}

