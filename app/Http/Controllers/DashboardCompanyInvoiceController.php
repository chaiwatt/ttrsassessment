<?php

namespace App\Http\Controllers;

use App\Model\FullTbp;
use Illuminate\Http\Request;
use PDF;

class DashboardCompanyInvoiceController extends Controller
{
        public function Invoice($id){
            // require_once (base_path('/vendor/notyes/thsplitlib/THSplitLib/segment.php'));
            // $segment = new \Segment();
            $fulltbp = FullTbp::find($id);
            // $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
            // $businessplan = BusinessPlan::find($minitbp->business_plan_id);
            // $company = Company::find($businessplan->company_id);
            // $ceo = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id',1)->first();
            // $companyboards = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id','<=',5)->where('id','!=',$ceo->id)->get();
            // $companyemploys = CompanyEmploy::where('full_tbp_id',$id)->where('employ_position_id','>',5)->where('id','!=',$ceo->id)->get();
            // $companyemploys = FullTbpResearcher::where('full_tbp_id',$id)->get(); 
            // return  $companyemploys;
            // $companyhistory = $segment->get_segment_array($company->companyhistory);
            // $companystockholders = CompanyStockHolder::where('company_id',$company->id)->get();
            $data = [
                'fulltbp' => $fulltbp
            ];

            // $pdf = PDF::loadView('dashboard.company.project.fulltbp.pdf', $data);
            // $path = public_path("storage/uploads/");
            // $pdf->save($path.$fulltbpcode.'invoice.pdf');

            $pdf = PDF::loadView('dashboard.company.project.invoice.invoicepdf', $data);
            // $path = public_path("storage/uploads/fulltbp/");
            return $pdf->stream('document.pdf');
        }

        
        // public function SampleInvoice(){
        //     $data = [
        //         'fulltbp' => 'nothing'
        //     ];
        //     $pdf = PDF::loadView('dashboard.company.project.invoice.invoicepdf', $data);
        //     return $pdf->stream('document.pdf');
        // }
}
