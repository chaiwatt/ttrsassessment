<?php

namespace App\Http\Controllers;
use Image;
use App\User;
use App\Model\Ev;
use Carbon\Carbon;
use App\Model\Isic;
use App\Helper\Crop;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Model\Company;
use App\Model\FullTbp;
use App\Model\IsicSub;
use App\Model\MiniTBP;
use App\Model\Province;
use App\Helper\EmailBox;
use App\Model\Companysize;
use App\Model\FullTbpCost;
use App\Model\BusinessPlan;
use App\Model\BusinessType;
use App\Model\FullTbpAsset;
use App\Model\FullTbpGantt;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use App\Model\IndustryGroup;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\CompanyAddress;
use App\Model\EmployPosition;
use App\Helper\DateConversion;
use App\Model\FullTbpEmployee;
use App\Model\EvaluationResult;
use App\Model\FullTbpCompanyDoc;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpSellStatus;
use App\Model\AuthorizedDirector;
use App\Model\CompanyServiceType;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectCertify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Model\FullTbpReturnOfInvestment;
use App\Http\Requests\EditCompanyRequest;
use App\Http\Requests\EditProfileRequest;
use App\Model\FullTbpCompanyProfileAttachment;

class SettingProfileUserController extends Controller
{
    public function Edit($userid){
        $user = User::find($userid);
        $company = Company::where('user_id',$user->id)->first();
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
        $authorizeddirectors = CompanyEmploy::where('company_id',$company->id)->where('employ_position_id','<=',5)->where('isdirector',1)->get();
        $employpositions = EmployPosition::where('id', '<=',5)->get();
        $companyservicetypes = CompanyServiceType::get();
        $companysizes = Companysize::get();
        $businesstypes = BusinessType::get();
        return view('setting.profile.user.edit')->withUser($user)
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
                                            ->withUserpositions($userpositions)
                                            ->withEmploypositions($employpositions)
                                            ->withCompanysizes($companysizes)
                                            ->withCompanyservicetypes($companyservicetypes)
                                            ->withBusinesstypes($businesstypes);
    }
    public function EditSave(EditProfileRequest $request, $id){
        $auth = Auth::user();
        $file = $request->picture; 
        $filelocation = $auth->company->logo;
        if(!Empty($file)){         
            if(!Empty($auth->company->logo)){
                if(strpos($auth->company->logo, 'assets\dashboard\images') !== true){
                    @unlink($auth->company->logo);
                }
            }
            $name = $file->getClientOriginalName();
            $file = $request->picture;
            $img = Image::make($file);  
            $fname=str_random(10).".".$file->getClientOriginalExtension();
            $filelocation = "storage/uploads/company/".$fname;
            Crop::crop(true,public_path("storage/uploads/company/"),$fname,Image::make($file),500,500,1);
        }
        
        if($request->registeredcapital == 0 && $auth->user_group_id == 1){
            return redirect()->back()->withError('ทุนจดทะเบียนไม่ถูกต้อง');  
        }
        if($request->paidupcapital == 0 && $auth->user_group_id == 1){
            return redirect()->back()->withError('ทุนจดทะเบียนที่เรียกชำระแล้วไม่ถูกต้อง');  
        }
        CreateUserLog::createLog('แก้ไขข้อมูลProfile');
        // $auth = Auth::user();
        if(!Empty($request->password)){
            $auth->update([
                'password' => Hash::make($request->password)
            ]);
        }
        $company = Company::where('user_id',$auth->id)->first();
         
        $paidupcapitaldate=null;
        if(!Empty($request->paidupcapitaldate)){
            $paidupcapitaldate=DateConversion::thaiToEngDate($request->paidupcapitaldate);
        }
        $reg = $request->registeredcapital;
        $_registeredcapital = 4;

        if($reg > 0 && $reg < 1000000){
            $_registeredcapital = 1;
        }else if($reg >= 1000000 && $reg < 5000000){
            $_registeredcapital = 2;
        }else if($reg >= 5000000 && $reg < 10000000){
            $_registeredcapital = 3;
        }

        $oldindustrygroupid = $company->industry_group_id;
        $industrygroup = IndustryGroup::find($oldindustrygroupid);
        if(!Empty($industrygroup->companybelong)){
            $industrygroup->update([
                'companybelong' => (intVal($industrygroup->companybelong) - 1)
            ]);
        }
        $industrygroup = IndustryGroup::find($request->industrygroup);
        IndustryGroup::find($request->industrygroup)->update([
            'companybelong' => (intVal($industrygroup->companybelong) + 1)
        ]);
        
        $company->update([
            'name' => $request->company,
            'vatno' => $request->vatno,
            'email' => $auth->email,
            'commercialregnumber' => $request->commercialregnumber,
            'isic_id' => $request->isic,
            'isic_sub_id' => $request->subisic,
            'registeredyear' => $request->registeredyear,
            'registeredcapital' => str_replace( ',', '', $request->registeredcapital),
            'registeredcapitaltype' => $_registeredcapital,
            'paidupcapital' => str_replace( ',', '', $request->paidupcapital),
            'paidupcapitaldate' => $paidupcapitaldate,
            'industry_group_id' => $request->industrygroup,
            'business_type_id' => $request->businesstype,
            'company_service_type_id' => $request->companyservicetype,
            'company_size_id' => $request->companysize,
            'phone' => $request->phone,
            'website' => $request->website,
            'fax' => $request->fax,
            'email' => $request->email,
            'logo' => $filelocation,
            'saveprofile' => 1
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
            'lastname' => $request->lastname,
            'hid' => $request->hid,
            'position' => $request->userposition
        ]);

        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        
        if(Empty($businessplan)){
            
                $count = BusinessPlan::get()->count() + 1;
                $auth = Auth::user();
                $company = Company::where('user_id',$auth->id)->first();
                $businessplan = new BusinessPlan();
                $businessplan->code = Carbon::now()->format('y') . Carbon::now()->format('m') . str_pad(($count),3,0,STR_PAD_LEFT); 
                $businessplan->company_id = $company->id;
                $businessplan->business_plan_status_id = 2;
                $businessplan->save();

                $minitbp = new MiniTBP();
                $minitbp->business_plan_id = $businessplan->id;
                $minitbp->industry_group_id = $company->industry_group_id;
                $minitbp->contactname = $auth->name;
                $minitbp->contactprefix = $user->prefix_id;
                $minitbp->contactposition = $user->position;
                $minitbp->contactlastname = $auth->lastname;
                $minitbp->contactemail = $auth->email;
                $minitbp->contactphone = $auth->phone;
                $minitbp->website = $company->website;
                $minitbp->save();

                $fulltbp = new FullTbp();
                $fulltbp->mini_tbp_id = $minitbp->id;
                $fulltbp->save();

                $fulltbpgantt = new FullTbpGantt();
                $fulltbpgantt->full_tbp_id = $fulltbp->id;
                $fulltbpgantt->startyear = intval(Carbon::now()->year) + 543 ;
                $fulltbpgantt->save();
                
                $fulltbpcompanydocs = FullTbpCompanyDoc::where('company_id',$company->id)->get();
               
                if($fulltbpcompanydocs->count() > 0){
                    
                    foreach ($fulltbpcompanydocs as $key => $fulltbpcompanydoc) {
                        $filename = basename($fulltbpcompanydoc->path); 
                        File::copy(public_path($fulltbpcompanydoc->path),public_path("storage/uploads/fulltbp/companyprofile/attachment/".$filename));
                        $fulltbpcompanyprofileattachment = new FullTbpCompanyProfileAttachment();
                        $fulltbpcompanyprofileattachment->full_tbp_id = $fulltbp->id;
                        $fulltbpcompanyprofileattachment->path = "storage/uploads/fulltbp/companyprofile/attachment/".$filename;
                        $fulltbpcompanyprofileattachment->name = $fulltbpcompanydoc->name;
                        $fulltbpcompanyprofileattachment->save();
                    }
                }
              
                $ev = new Ev();
                $ev->full_tbp_id = $fulltbp->id;
                $ev->save();

                $evaluationresult = new EvaluationResult();
                $evaluationresult->full_tbp_id = $fulltbp->id;
                $evaluationresult->save();

                $fulltbpemployee = new FullTbpEmployee();
                $fulltbpemployee->full_tbp_id = $fulltbp->id;
                $fulltbpemployee->save();

                $fulltbpcompanyprofile = new FullTbpCompanyProfile();
                $fulltbpcompanyprofile->full_tbp_id = $fulltbp->id;
                $fulltbpcompanyprofile->save();

                $fulltbpprojectcertify = new FullTbpProjectCertify();
                $fulltbpprojectcertify->full_tbp_id = $fulltbp->id;
                $fulltbpprojectcertify->save();

                $projectmember = ProjectMember::where('full_tbp_id',$fulltbp->id)
                                            ->where('user_id',$auth->id)->first();
                // if(Empty($projectmember)){
                //     $projectmember = new ProjectMember();
                //     $projectmember->full_tbp_id = $fulltbp->id;
                //     $projectmember->user_id = User::where('user_type_id',5)->first()->id;
                //     $projectmember->save();

                //     $projectmember = new ProjectMember();
                //     $projectmember->full_tbp_id = $fulltbp->id;
                //     $projectmember->user_id = User::where('user_type_id',6)->first()->id;
                //     $projectmember->save();
                // }
                
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
                return redirect()->route('dashboard.company.project.minitbp.edit',['id'=>$minitbp->id])->withSuccess('บันทึกข้อมูลสำเร็จ กรุณากรอกแบบคำขอเพื่อขอรับการประเมินธุรกิจ'); 
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

            $businessplanarr = BusinessPlan::where('company_id',$company->id)->pluck('id')->toArray();
            MiniTBP::whereIn('business_plan_id',$businessplanarr)->update([
                'industry_group_id' => $company->industry_group_id
            ]);
            

            return redirect()->back()->withSuccess('แก้ไขข้อมูล Profile สำเร็จ'); 
        }
    }
}
