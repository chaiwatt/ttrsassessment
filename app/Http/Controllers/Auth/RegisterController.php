<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Company;
use App\Model\GeneralInfo;
use App\Model\BusinessPlan;
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
            return 'dashboard/company';
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
            'phone' => 'required|numeric|digits_between:10,13',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'prefix_id' => 1,
            'user_type_id' => 3,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'verify_type' => GeneralInfo::first()->verify_type_id,
        ]);
        Company::create([
            'name' => 'บริษัท'.$data['name'],
            'user_id' => $user->id,
            'province_id' => 4,
            'amphur_id' => 67,
            'tambol_id' => 367,
        ]);

        BusinessPlan::create([
            'company_id' => Company::latest()->first()->id
        ]);
        return $user ; 
    }
}
