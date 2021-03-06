<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use Carbon\Carbon;
use App\Model\Isic;
use App\Helper\Crop;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Helper\TinPin;
use App\Model\AsicSub;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\IsicSub;
use App\Model\MiniTBP;
use App\Model\Province;
use App\Model\FullTbpCost;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\FullTbpAsset;
use App\Model\FullTbpGantt;
use App\Model\IndustryGroup;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Model\CompanyAddress;
use App\Helper\DateConversion;
use App\Model\FullTbpEmployee;
use App\Model\FullTbpCompanyDoc;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpSellStatus;
use App\Model\AuthorizedDirector;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectCertify;
use App\Model\RegisteredCapitalType;
use Illuminate\Support\Facades\Auth;
use App\Model\FullTbpReturnOfInvestment;
use App\Http\Requests\EditCompanyRequest;

class SettingUserCompanyController extends Controller
{
    public function Edit($userid){
        $user = User::find($userid);
        // $registeredcapitaltypes = RegisteredCapitalType::get();
        $industrygroups = IndustryGroup::get();
        $businesstypes = BusinessType::get();
        $company = Company::where('user_id',$user->id)->first();
        $companyinfo = TinPin::tinpin($company->vatno);
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$company->province_id)->get();
        $tambols = Tambol::where('amphur_id',$company->amphur_id)->get();
        $isics = Isic::get();
        $isicsubs = IsicSub::where('isic_id',$company->isic_id)->get();
        $registeredyear='';
        if(!Empty($companyinfo)){
            $registeredyear = substr(json_decode($companyinfo->getContent(), true)[0]['registerdateth'], -4);
        }
        $prefixes = Prefix::get();
        $fulltbpcompanydocs = FullTbpCompanyDoc::get();
        $authorizeddirectors = AuthorizedDirector::where('company_id',$company->id)->get();

        return view('setting.user.company.edit')->withCompany($company)
                                        // ->withRegisteredcapitaltypes($registeredcapitaltypes)
                                        ->withIndustrygroups($industrygroups)
                                        ->withBusinesstypes($businesstypes)
                                        ->withAmphurs($amphurs)
                                        ->withTambols($tambols)
                                        ->withProvinces($provinces)
                                        ->withRegisteredyear($registeredyear)
                                        ->withIsics($isics)
                                        ->withIsicsubs($isicsubs)
                                        ->withPrefixes($prefixes)
                                        ->withFulltbpcompanydocs($fulltbpcompanydocs)
                                        ->withAuthorizeddirectors($authorizeddirectors);
    }

    public function EditSave(EditCompanyRequest $request, $id){
        
        $company = Company::find($id);
        $file = $request->picture; 
        $filelocation = $company->logo;
        if(!Empty($file)){         
            if(!Empty($company->logo)){
                @unlink($company->logo);
            }
            $name = $file->getClientOriginalName();
            $file = $request->picture;
            $img = Image::make($file);  
            $fname=str_random(10).".".$file->getClientOriginalExtension();
            $filelocation = "storage/uploads/company/".$fname;
            Crop::crop(true,public_path("storage/uploads/company/"),$fname,Image::make($file),500,500,1);
        }
        $paidupcapitaldate=null;
        if(!Empty($request->paidupcapitaldate)){
            $paidupcapitaldate=DateConversion::thaiToEngDate($request->paidupcapitaldate);
        }
        $company->update([
            'name' => $request->company,
            'commercialregnumber' => $request->commercialregnumber,
            'registeredyear' => $request->registeredyear,
            'registeredcapital' => $request->registeredcapital,
            'paidupcapital' => $request->paidupcapital,
            'paidupcapitaldate' => $paidupcapitaldate,
            'industry_group_id' => $request->industrygroup,
            'business_type_id' => $request->businesstype,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'email' => $request->email,
            'logo' => $filelocation,
        ]);
        CompanyAddress::where('company_id',$company->id)->first()->update([
            'address' => $request->address,
            'province_id' => $request->province,
            'amphur_id' => $request->amphur,
            'tambol_id' => $request->tambol,
            'postalcode' => $request->postalcode,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);
        $user = Auth::user();
        $user->update([
            'prefix_id' => $request->prefix,
            'alter_prefix' => $request->alter_prefix,
            'name' => $request->name,
            'lastname' => $request->lastname
        ]);

        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        if(Empty($businessplan)){
                $count = BusinessPlan::get()->count() + 1;
                $businessplan = new BusinessPlan();
                $businessplan->code = Carbon::now()->format('y') . Carbon::now()->format('m') . str_pad(($count),3,0,STR_PAD_LEFT); 
                $businessplan->company_id = $company->id;
                $businessplan->business_plan_status_id = 2;
                $businessplan->save();

                $minitbp = new MiniTBP();
                $minitbp->business_plan_id = $businessplan->id;
                $minitbp->save();

                $fulltbp = new FullTbp();
                $fulltbp->mini_tbp_id = $minitbp->id;
                $fulltbp->save();

                $fulltbpgantt = new FullTbpGantt();
                $fulltbpgantt->full_tbp_id = $fulltbp->id;
                $fulltbpgantt->startyear = intval(Carbon::now()->year) + 543 ;
                $fulltbpgantt->save();

                $fulltbpemployee = new FullTbpEmployee();
                $fulltbpemployee->full_tbp_id = $fulltbp->id;
                $fulltbpemployee->save();

                $fulltbpcompanyprofile = new FullTbpCompanyProfile();
                $fulltbpcompanyprofile->full_tbp_id = $fulltbp->id;
                $fulltbpcompanyprofile->save();

                $fulltbpprojectcertify = new FullTbpProjectCertify();
                $fulltbpprojectcertify->full_tbp_id = $fulltbp->id;
                $fulltbpprojectcertify->save();

                $sellstatus = array("1. ยอดขายในประเทศ", "2. ยอดขายส่งออก", "  -  ยอดขายเปิด L/C (Letter of Credit) กับสถาบันการเงิน","  -  วงเงินตามสัญญา L/C ที่มีกับสถาบันการเงิน");

                foreach ($sellstatus as $status) {
                    FullTbpSellStatus::create([
                        'full_tbp_id' => $fulltbp->id,
                        'name' => $status
                    ]);
                }
                $assets = array("ค่าที่ดิน", "ค่าอาคารและสิ่งปลูกสร้าง", "ค่าตกแต่งอาคารและสิ่งปลูกสร้าง","ค่าเครื่องจักร","ค่าคอมพิวเตอร์","อื่นๆ");
                foreach ($assets as $asset) {
                    FullTbpAsset::create([
                        'full_tbp_id' => $fulltbp->id,
                        'asset' => $asset
                    ]);
                }
                $investments = array("ค่าใช้จ่ายในการจัดตั้งธุรกิจ (กรณีเพิ่งเริ่มจัดตั้งธุรกิจ)", "ค่าใช้จ่ายในการพัฒนาเทคโนโลยีหลักที่ใช้ในกระบวนการผลิตและบริการ", "ค่าใช้จ่ายในกระบวนการผลิต (เช่น ค่าวัตถุดิบ, ค่าแรง, ค่าใช้จ่ายในการผลิต)","ค่าใช้จ่ายในการดำเนินงาน","ค่าใช้จ่ายอื่นๆ");
                foreach ($investments as $investment) {
                    FullTbpInvestment::create([
                        'full_tbp_id' => $fulltbp->id,
                        'investment' => $investment
                    ]);
                }

                $costs = array("แหล่งเงินทุนภายใน", "แหล่งเงินทุนภายนอก");
                foreach ($costs as $cost) {
                    FullTbpCost::create([
                        'full_tbp_id' => $fulltbp->id,
                        'costname' => $cost
                    ]);
                }

                $fulltbpreturnofinvestment = new FullTbpReturnOfInvestment();
                $fulltbpreturnofinvestment->full_tbp_id = $fulltbp->id;
                $fulltbpreturnofinvestment->save();
        }else{
            if($request->status == 1){
                $businessplan->where('company_id',$company->id)->first()->update([
                    'business_plan_active_status_id' => '1'
                ]);
            }else{
                $businessplan->where('company_id',$company->id)->first()->update([
                    'business_plan_active_status_id' => '2'
                ]);
            }
        }

        return redirect()->back()->withSuccess('แก้ไขข้อมูลสถานประกอบการสำเร็จ'); 
    }
}
