<?php

namespace App\Imports;

use App\User;
use Carbon\Carbon;
use App\Model\Company;
use App\Model\ExpertDetail;
use App\Model\OfficerDetail;
use App\Model\CompanyAddress;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if($row['type'] == 1 && !empty( $row['name']) && !empty( $row['lastname']) && !empty( $row['email'])){
            $this->createOfficer($row['name'],$row['lastname'],$row['email']);
        }else if($row['type'] == 2 && !empty( $row['name']) && !empty( $row['lastname']) && !empty( $row['email'])){
            $this->createExpert($row['name'],$row['lastname'],$row['email']);
        }
        return ;
    }

    public function createOfficer($name,$lastname,$email){

        $check = User::where('email',str_replace(' ', '', $email))->first();
        if(empty($check)){
            $user = new User();
            $user->prefix_id = 4;
            $user->user_type_id = 4;
            $user->name = str_replace(' ', '', $name);
            $user->lastname = str_replace(' ', '', $lastname);
            $user->email = str_replace(' ', '', $email);
    
            $user->password = Hash::make('11111111');
            $user->verify_type = 1;
            $user->email_verified_at = Carbon::now()->toDateString();
            $user->user_group_id = 2;
            $user->save();
    
            $company = new Company();
            $company->vatno = $this->randomCitizenID();
            $company->user_id = $user->id;
    
            $company->logo = 'assets/dashboard/images/user.png';
            $company->business_type_id = 5;
            $company->save();
    
            $companyaddress = new CompanyAddress();
            $companyaddress->company_id = $company->id;
    
            $companyaddress->save(); 
    
            $officerdetail = new OfficerDetail();
            $officerdetail->user_id = $user->id;
            $officerdetail->save();
        }

    }

    public function createExpert($name,$lastname,$email){
        $check = User::where('email',str_replace(' ', '', $email))->first();
        if(empty($check)){
            $user = new User();
            $user->prefix_id = 4;
            $user->user_type_id = 3;
            $user->name = str_replace(' ', '', $name);
            $user->lastname = str_replace(' ', '', $lastname);
            $user->email = str_replace(' ', '', $email);
            $user->password = Hash::make('11111111');
            $user->verify_type = 1;
            $user->email_verified_at = Carbon::now()->toDateString();
            $user->user_group_id = 2;
            $user->save();
    
            $company = new Company();
            $company->vatno = $this->randomCitizenID();
            $company->user_id = $user->id;
            $company->logo = 'assets/dashboard/images/user.png';
            $company->business_type_id = 5;
            $company->save();
    
            $companyaddress = new CompanyAddress();
            $companyaddress->company_id = $company->id;
            $companyaddress->save(); 
    
            $expertdetail = new ExpertDetail();
            $expertdetail->user_id = $user->id;
            $expertdetail->expert_type_id = 1;
            $expertdetail->save();
        }

    }

    function randomCitizenID(){ 
        $firstNumber = null;
        $lastNumber = null;
        $numberCalc = null;
        for($i=0;$i<12;$i++){  
            $k = abs($i + (-13));  
            $m = rand(0,9);  
            $firstNumber .= $m; // ตัวเลขชุดแรก (12 หลัก)  
            $numberCalc += ($k * $m);  
        }  
        $lastNumber = 11 - ($numberCalc % 11); // ตัวเลขหลักสุดท้าย  
        return $firstNumber.$lastNumber;  
    }  
}
