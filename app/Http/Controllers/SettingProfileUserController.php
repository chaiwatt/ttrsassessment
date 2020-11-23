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
use App\Model\FullTbpCost;
use App\Model\BusinessPlan;
use App\Model\FullTbpAsset;
use App\Model\UserPosition;
use App\Model\IndustryGroup;
use App\Model\ProjectMember;
use Illuminate\Http\Request;
use App\Model\CompanyAddress;
use App\Helper\DateConversion;
use App\Model\FullTbpEmployee;
use App\Model\EvaluationResult;
use App\Model\FullTbpCompanyDoc;
use App\Model\FullTbpInvestment;
use App\Model\FullTbpSellStatus;
use App\Model\AuthorizedDirector;
use App\Model\FullTbpCompanyProfile;
use App\Model\FullTbpProjectCertify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Model\FullTbpReturnOfInvestment;
use App\Http\Requests\EditCompanyRequest;
use App\Http\Requests\EditProfileRequest;

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
        $authorizeddirectors = AuthorizedDirector::where('company_id',$company->id)->get();
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
                                            ->withUserpositions($userpositions);
    }
    public function EditSave(EditProfileRequest $request, $id){
        $auth = Auth::user();
        if(!Empty($request->password)){
            $auth->update([
                'password' => Hash::make($request->password)
            ]);
        }
        $company = Company::where('user_id',$auth->id)->first();
        $file = $request->picture; 
        $filelocation = $company->logo;
        if(!Empty($file)){   
            $extension_picture = array('jpg' , 'JPG' , 'jpeg' , 'JPEG' , 'GIF' , 'gif' , 'PNG' , 'png');     
            if( in_array($file->getClientOriginalExtension(), $extension_picture) ){
                if(!Empty($company->logo)){
                    @unlink($company->logo);
                }
                $name = $file->getClientOriginalName();
                $file = $request->picture;
                $img = Image::make($file);  
                $fname=str_random(10).".".$file->getClientOriginalExtension();
                $filelocation = "storage/uploads/company/".$fname;
                Crop::crop(true,public_path("storage/uploads/company/"),$fname,Image::make($file),500,500,1);
            }else{
                return redirect()->back()->withError('รูปแบบไฟล์ภาพไม่ถูกต้อง'); 
            }
        }
        $paidupcapitaldate=null;
        if(!Empty($request->paidupcapitaldate)){
            $paidupcapitaldate=DateConversion::thaiToEngDate($request->paidupcapitaldate);
        }
        $company->update([
            'name' => $request->company,
            'vatno' => $request->vatno,
            'email' => $auth->email,
            'commercialregnumber' => $request->commercialregnumber,
            'isic_id' => $request->isic,
            'isic_sub_id' => $request->subisic,
            'registeredyear' => $request->registeredyear,
            'registeredcapital' => $request->registeredcapital,
            'paidupcapital' => $request->paidupcapital,
            'paidupcapitaldate' => $paidupcapitaldate,
            'industry_group_id' => $request->industrygroup,
            'business_type_id' => $request->businesstype,
            'phone' => $request->phone,
            'website' => $request->website,
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
            'name' => $request->name,
            'lastname' => $request->lastname,
            'hid' => $request->hid
        ]);

        $businessplan = BusinessPlan::where('company_id',$company->id)->first();
        if(Empty($businessplan)){
            // if($request->status == 1){
                $auth = Auth::user();
                $company = Company::where('user_id',$auth->id)->first();
                $businessplan = new BusinessPlan();
                $businessplan->code = Carbon::now()->timestamp;
                $businessplan->company_id = $company->id;
                $businessplan->business_plan_status_id = 2;
                $businessplan->save();

                $minitbp = new MiniTBP();
                $minitbp->business_plan_id = $businessplan->id;
                $minitbp->contactname = $auth->name;
                $minitbp->contactlastname = $auth->lastname;
                $minitbp->contactemail = $auth->email;
                $minitbp->contactphone = $auth->phone;
                $minitbp->website = $company->website;
                $minitbp->save();

                $fulltbp = new FullTbp();
                $fulltbp->mini_tbp_id = $minitbp->id;
                $fulltbp->save();

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
                if(Empty($projectmember)){
                    $projectmember = new ProjectMember();
                    $projectmember->full_tbp_id = $fulltbp->id;
                    $projectmember->user_id = User::where('user_type_id',5)->first()->id;
                    $projectmember->save();

                    $projectmember = new ProjectMember();
                    $projectmember->full_tbp_id = $fulltbp->id;
                    $projectmember->user_id = User::where('user_type_id',6)->first()->id;
                    $projectmember->save();
                }

                // $notificationbubble = new NotificationBubble();
                // $notificationbubble->business_plan_id = $businessplan->id;
                // $notificationbubble->notification_category_id = 1;
                // $notificationbubble->notification_sub_category_id = 2;
                // $notificationbubble->user_id = $auth->id;
                // $notificationbubble->target_user_id = User::where('user_type_id',6)->first()->id;
                // $notificationbubble->save();
                
                $sellstatus = array("ยอดขายในประเทศ", "ยอดขายส่งออก", "ยอดขายเปิด L/C (Letter of Credit) กับสถาบันการเงิน","วงเงินตามสัญญา L/C ที่มีกับสถาบันการเงิน");

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

                // $messagebox = new MessageBox();
                // $messagebox->title = 'ขอรับการประเมินใหม่';
                // $messagebox->message_priority_id = 1;
                // $messagebox->body = Company::where('user_id',$auth->id)->first()->name . 'ขอรับการประเมินใหม่';
                // $messagebox->sender_id = $auth->id;
                // $messagebox->receiver_id = User::where('user_type_id',6)->first()->id;
                // $messagebox->message_read_status_id = 1;
                // $messagebox->save();

                // $alertmessage = new AlertMessage();
                // $alertmessage->user_id = $auth->id;
                // $alertmessage->target_user_id = User::where('user_type_id',6)->first()->id;
                // $alertmessage->detail = Company::where('user_id',$auth->id)->first()->name . 'ขอรับการประเมินใหม่ ส่งเมื่อ ' . DateConversion::engToThaiDate(Carbon::now()->toDateString());
                // $alertmessage->save();
                
                // EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS:ขอรับการประเมินใหม่','เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้สร้างรายการขอการประเมิน โปรดตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.businessplan.view',['id' => $businessplan->id]).'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS');
                // Message::sendMessage('ขอรับการประเมินใหม่','เรียน JD<br> '. Company::where('user_id',Auth::user()->id)->first()->name . ' ได้สร้างรายการขอการประเมิน โปรดตรวจสอบ ได้ที่ <a href='.route('dashboard.admin.project.businessplan.view',['id' => $businessplan->id]).'>คลิกที่นี่</a> <br><br>ด้วยความนับถือ<br>TTRS',Auth::user()->id,User::where('user_type_id',6)->first()->id);
            // }
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

        return redirect()->back()->withSuccess('แก้ไขข้อมูลสำเร็จ'); 
    }
}