<?php

namespace App\Http\Controllers;

use PDF;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\CompanyBoard;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\EmployPosition;
use App\Model\EmployTraining;
use App\Model\EmployEducation;
use App\Model\FullTbpEmployee;
use App\Model\EmployExperience;
use App\Model\CompanyStockHolder;
use App\Model\FullTbpProductDetail;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectTechDev;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpMainProductDetail;
use App\Model\FullTbpProjectTechDevLevel;
use App\Model\FullTbpCompanyProfileDetail;
use App\Model\FullTbpProjectAbtractDetail;
use App\Model\FullTbpProjectTechDevProblem;
use App\Model\FullTbpCompanyProfileAttachment;

class DashboardCompanyFullTbpController extends Controller
{
    public function Index(){
        $companyinfo = collect();
        $company = Company::where('user_id',Auth::user()->id)->first();
        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        $minitbp = MiniTBP::where('business_plan_id',$businessplan->id)->first();
        $fulltpbs = FullTbp::where('mini_tbp_id',$minitbp->id)->get();   
        return view('dashboard.company.fulltbp.index')->withFulltbps($fulltpbs);
    }

    public function Edit($id){
        $businesstypes = BusinessType::get();
        $fulltbp = FullTbp::find($id);
        $fulltbpcompanyprofile = FullTbpCompanyProfile::where('full_tbp_id',$fulltbp->id)->first();
        $fulltbpemployee = FullTbpEmployee::where('full_tbp_id', $fulltbp->id)->first();
        $fulltbpcompanyprofiledetails = FullTbpCompanyProfileDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpcompanyprofileattachments = FullTbpCompanyProfileAttachment::where('full_tbp_id',$fulltbp->id)->get();
        $company = Company::where('user_id',Auth::user()->id)->first();
        $prefixes = Prefix::get();
        $employpositions = EmployPosition::get();
        $companyemploys = CompanyEmploy::where('company_id',$company->id)->get();
        $companystockholders = CompanyStockHolder::where('company_id',$company->id)->get();
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        $contactprefixes = Prefix::get();
        $contactpositions = UserPosition::get();
        $fulltbpprojectabtractdetails = FullTbpProjectAbtractDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpMainproductdetails = FullTbpMainProductDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpproductdetails = FullTbpProductDetail::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevs = FullTbpProjectTechDev::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevlevels = FullTbpProjectTechDevLevel::where('full_tbp_id',$fulltbp->id)->get();
        $fulltbpprojecttechdevproblems = FullTbpProjectTechDevProblem::where('full_tbp_id',$fulltbp->id)->get();
        return view('dashboard.company.fulltbp.edit')->withFulltbp($fulltbp)
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
                                                ->withFulltbpprojecttechdevproblems($fulltbpprojecttechdevproblems);
    }

    public function EditSave(Request $request,$id){
        // return $request->department1_qty;
        FullTbpEmployee::find($id)->update([
            'department1_qty' => $request->department1_qty,
            'department2_qty' => $request->department2_qty,
            'department3_qty' => $request->department3_qty,
            'department4_qty' => $request->department4_qty,
            'department5_qty' => $request->department5_qty,
        ]); 
        $fulltbp = FullTbp::find($id); 
        FullTbpCompanyProfile::where('full_tbp_id',$fulltbp->id)->first()->update([
               'profile' => $request->companyprofile
            ]);

        FullTbpCompanyProfileDetail::where('full_tbp_id',$fulltbp->id)->delete();
        foreach( $request->companyprofile as $companyprofile ){
            $fulltbpcompanyprofiledetail = new FullTbpCompanyProfileDetail();
            $fulltbpcompanyprofiledetail->full_tbp_id = $fulltbp->id;
            $fulltbpcompanyprofiledetail->line = $companyprofile;
            $fulltbpcompanyprofiledetail->save();
        }

        return redirect()->back()->withSuccess('แก้ไข Full TBP สำเร็จ');
    }

    public function DownloadPDF($id){
        // require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
        // $segment = new \Segment();
        // $body = 'หาดทรายละเอียดสีขาวตัดกับท้องฟ้าและน้ำทะเลสีครามใสคือบรรยากาศของท้องทะเลไทยในช่วงของการแพร่ ระบาดไวรัสโควิด-19ส่งผลให้ประเทศไทยมีการประกาศพ.ร.ก.ฉุกเฉินและปิดบริการสถานที่ท่องเที่ยวทางธรรมชาติทั่วประเทศเสมือนกำลังสร้างความสมดุลของ ระบบนิเวศให้กลับคืนสู่ธรรมชาติอีกครั้ง ส่วนการเปิดโรงเรียน ที่ประชุม ศบค.มีความเห็นว่า เนื่องจากโรงเรียนมีขนาดต่างกันและมีจำนวนมากจึงสั่งให้ประเมินความพร้อมเป็นรายแห่ง ให้กระทรวงศึกษาประเมินอีกครั้งภายในวันที่ 15 มิ.ย.';
        // $words = $segment->get_segment_array($body);
        // $text = implode("|",$words);
        $text ='test';
        $data = ['title' => 'ทดสอบ', 'body' => $text];
        $pdf = PDF::loadView('dashboard.company.fulltbp.pdf', $data);
        return $pdf->stream('document.pdf');
    }

}
