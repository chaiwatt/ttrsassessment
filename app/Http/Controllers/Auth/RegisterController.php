<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Company;
use App\Model\UserGroup;
use App\Model\GeneralInfo;
use App\Model\BusinessPlan;
use App\Model\ExpertDetail;
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
            return 'dashboard/company/report';
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
            'usergroup' => 'required',
            'vatno' => 'required_if:usergroup,==,1'
        ]);
    }

    protected function create(array $data)
    {
        // $group = 2;
        $experttype = 0;
    //    if(!Empty($data['vatno'])){
    //         $group =1;
    //    }
        $usertype = 1;
        if($data['user_type'] == 2){
            $usertype = 4;
        }elseif($data['user_type'] == 3){
            $usertype = 3;
            // if($data['expert'] == 2){
            //     $experttype = 1;
            // }
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
            // 'expert_type' => $experttype,
            'password' => Hash::make($data['password']),
            'verify_type' => GeneralInfo::first()->verify_type_id,
        ]);
        $companyname= '';
        $vatno = $data['vatno'];
        if($data['usergroup'] == 1){
            $companyname = $data['companyname'];  
        }
        if($user->user_type_id == 3){
            $xpertdetail = new ExpertDetail();
            $xpertdetail->user_id = $user->id;
            $xpertdetail->expert_type_id = $data['expert'];
            $xpertdetail->save();
        }
        CreateCompany::createCompany($user,$companyname,$vatno);
        return $user ; 
    }

    public function showRegistrationForm()
    {
        $usergroups = UserGroup::get();
        return view('auth.register')->withUsergroups($usergroups);
    }
}
