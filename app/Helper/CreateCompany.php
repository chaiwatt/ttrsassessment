<?php
namespace App\Helper;

use App\Model\Company;
use App\Model\BusinessPlan;
use Illuminate\Support\Facades\DB;

class CreateCompany
{
    public static function createCompany($user,$companyname){
        Company::create([
            'name' => 'บริษัท'.$companyname,
            'user_id' => $user->id,
            'province_id' => 4,
            'amphur_id' => 67,
            'tambol_id' => 367,
        ]);

        BusinessPlan::create([
            'company_id' => Company::latest()->first()->id
        ]);
        return ;
    } 
}

