<?php
namespace App\Helper;

use App\Model\Company;
use App\Model\BusinessPlan;
use App\Model\CompanyAddress;
use Illuminate\Support\Facades\DB;

class CreateCompany
{
    public static function createCompany($user,$companyname,$vatno,$businesstype){
       $company = Company::create([
            'name' => $companyname,
            'user_id' => $user->id,
            'vatno' => $vatno,
            // 'province_id' => 4,
            // 'amphur_id' => 67,
            // 'tambol_id' => 367,
            // 'postalcode' => '12120',
            // 'factoryprovince_id' => 4,
            // 'factoryamphur_id' => 67,
            // 'factorytambol_id' => 367,
            'business_type_id' => $businesstype,
            // 'factorypostalcode' => '12120'
        ]);
        $companyaddress = CompanyAddress::create([
            'company_id' => $company->id,
            'province_id' => 4,
            'amphur_id' => 67,
            'tambol_id' => 367,
            'postalcode' => '12120'
        ]);
        return ;
    } 
}
