<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Company;
use App\Helper\EmailBox;
use App\Model\UserGroup;
use App\Model\GeneralInfo;
use App\Model\BusinessPlan;
use App\Model\ExpertDetail;
use App\Model\OfficerDetail;
use App\Helper\CreateCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;
    // protected $redirectTo = 'line';//'dashboard/company';// '/sms'; //RouteServiceProvider::HOME;
    protected function redirectTo()
    {
         $generalinfo = GeneralInfo::first(); 
        if($generalinfo->verify_type_id == 1){
            if(Auth::user()->user_type_id <= 2){
                return 'dashboard/company/report';
            }else if(Auth::user()->user_type_id == 3){
                if($generalinfo->verify_expert_status_id == 2){
                    if(Auth::user()->verify_expert == 1){
                        Auth::logout();
                        Session::flush();
                        return redirect()->route('login')->withError('บัญชียังไม่ได้เปิดใช้งาน กรุณาติดต่อ JD');
                    }else{
                        return 'dashboard/expert/report';
                    }
                }else{
                    return 'dashboard/expert/report';
                }
            }else if(Auth::user()->user_type_id >= 4){
                if($generalinfo->verify_expert_status_id == 2){
                    if(Auth::user()->verify_expert == 1){
                        Auth::logout();
                        Session::flush();
                        return redirect()->route('login')->withError('บัญชียังไม่ได้เปิดใช้งาน กรุณาติดต่อ JD');
                    }else{
                        return 'dashboard/admin/report';
                    }
                }else{
                    return 'dashboard/admin/report';
                }
            }
        }else if($generalinfo->verify_type_id == 2){
            return 'line';
        }else if($generalinfo->verify_type_id == 3){
            return 'email';
        }else if($generalinfo->verify_type_id == 4){
            return 'sms';
        }
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'vatno' => ['required', 'numeric','unique:companies'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => 'required|numeric',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'usergroup' => 'required'
        ],
        [
            'name.required' => 'ยังไม่ได้กรอกชื่อ',
            'lastname.required' => 'ยังไม่ได้กรอกนามสกุล',
            'vatno.required' => 'ยังไม่ได้กรอกเลขประจำตัวผู้เสียภาษีอากร/บัตรประชาชน',
            'phone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
            'email.required' => 'ยังไม่ได้กรอกอีเมล',
            'password.required' => 'ยังไม่ได้กรอกรหัสผ่าน',
            'password.confirmed' => 'ยังไม่ได้กรอกรหัสผ่าน',
            'email.unique' => 'อีเมลนี้ลงทะเบียนแล้ว',
            'email.required' => 'ยังไม่ได้กรอกอีเมล'
        ]);
    }

    protected function create(array $data)
    {
        $experttype = 0;
        $usertype = 1;
        if($data['user_type'] == 2){
            $usertype = 4;
        }elseif($data['user_type'] == 3){
            $usertype = 3;
        }
        $companyname= '';
        $vatno = $data['vatno'];
        $businesstype = 5;
        $hid = $vatno;
        if($data['usergroup'] == 1){   //1 = นิติบุคคล 2 = บุคคลธรรมดา
            $companyname = $data['companyname'];  
            $businesstype = 2;
            $hid = '';
        }
        $user = User::create([
            'prefix_id' => 1,
            'user_type_id' => 2,
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'user_group_id' => $data['usergroup'],
            'user_type_id' => $usertype,
            'hid' => $hid,
            'password' => Hash::make($data['password']),
            'verify_type' => GeneralInfo::first()->verify_type_id,
        ]);
         $officertype = "ผู้เชี่ยวชาญ";
        if($user->user_type_id == 3){
            $xpertdetail = new ExpertDetail();
            $xpertdetail->user_id = $user->id;
            $xpertdetail->expert_type_id = $data['expert'];
            $xpertdetail->save();
        }
        if($user->user_type_id == 4){
            $officertype = "เจ้าหน้าที TTRS";
            $xpertdetail = new OfficerDetail();
            $xpertdetail->user_id = $user->id;
            $xpertdetail->save();
        }
        if($companyname == "บัตรประจำตัวประชาชน"){
            $companyname = "";
        }
        $companyname =  str_replace("บริษัท","",$companyname);
        $companyname =  str_replace("ห้างหุ้นส่วน","",$companyname);
        CreateCompany::createCompany($user,$companyname,$vatno,$businesstype);
        $generalinfo = GeneralInfo::first();
        
        if($generalinfo->verify_expert_status_id == 2){
            if($user->user_type_id == 3 || $user->user_type_id == 4){
                EmailBox::send(User::where('user_type_id',6)->first()->email,'TTRS: คุณ'. $user->name . ' ' .  $user->lastname .' ได้สมัครเป็น'.$officertype,'เรียน JD<br><br> คุณ'. $user->name . ' ' .  $user->lastname .' ได้สมัครเป็น'.$officertype.' กรุณาตรวจสอบ/Verify ได้ที่ <a href='.route('setting.admin.user').'>คลิกที่นี่</a><br><br>ด้วยความนับถือ<br>TTRS' . EmailBox::emailSignature());
            }  
        }
        return $user ; 
    }

    public function showRegistrationForm()
    {
        $usergroups = UserGroup::get();
        return view('auth.register')->withUsergroups($usergroups);
    }
}
