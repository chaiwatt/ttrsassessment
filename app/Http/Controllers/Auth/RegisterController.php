<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Company;
use App\Model\GeneralInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = 'line';//'dashboard/company';// '/sms'; //RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        $auth = Auth::user(); 
        if($auth->verify_type == 1){
            return 'dashboard/company';
        }else if($auth->verify_type == 2){
            return 'line';
        }else if($auth->verify_type == 3){
            return 'email';
        }else if($auth->verify_type == 4){
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
            'user_type_id' => 1,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'verify_type' => GeneralInfo::first()->verify_status_id,
        ]);
        Company::create([
            'name' => 'บริษัท'.$data['name'],
            'user_id' => $user->id
        ]);
        return $user ; 
    }
}
