<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use Illuminate\Http\Request;
use App\Model\FullTbpEmployee;
use App\Model\FullTbpCompanyProfile;
use Illuminate\Support\Facades\Auth;
use PDF;
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
        return view('dashboard.company.fulltbp.edit')->withFulltbp($fulltbp)
                                                ->withFulltbpemployee($fulltbpemployee)
                                                ->withBusinesstypes($businesstypes)
                                                ->withFulltbpcompanyprofile($fulltbpcompanyprofile);
    }

    public function EditSave(Request $request,$id){
        return 'od';
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
