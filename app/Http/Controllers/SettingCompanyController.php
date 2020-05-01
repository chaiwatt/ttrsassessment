<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Amphur;
use App\Model\Tambol;
use App\Model\Company;
use App\Model\Province;
use App\Model\BusinessType;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Model\RegisteredCapitalType;
use App\Http\Requests\EditCompanyRequest;


class SettingCompanyController extends Controller
{
    public function Edit($userid){
        $user = User::find($userid);
        $registeredcapitaltypes = RegisteredCapitalType::get();
        $industrygroups = IndustryGroup::get();
        $businesstypes = BusinessType::get();
        $company = Company::where('user_id',$user->id)->first();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$company->province_id)->get();
        $tambols = Tambol::where('amphur_id',$company->amphur_id)->get();
        return view('setting.company.edit')->withCompany($company)
                                        ->withRegisteredcapitaltypes($registeredcapitaltypes)
                                        ->withIndustrygroups($industrygroups)
                                        ->withBusinesstypes($businesstypes)
                                        ->withAmphurs($amphurs)
                                        ->withTambols($tambols)
                                        ->withProvinces($provinces);
    }

    public function EditSave(EditCompanyRequest $request, $id){
        Company::find($id)->update([
            'name' => $request->name,
            'registered_capital_type_id' => $request->registeredcapitaltype,
            'industry_group_id' => $request->industrygroup,
            'business_type_id' => $request->businesstype,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'email' => $request->email,
            'address' => $request->address,
            'province_id' => $request->province,
            'amphur_id' => $request->amphur,
            'tambol_id' => $request->tambol,
            'postalcode' => $request->postalcode
        ]);
        return redirect()->back()->withSuccess('แก้ไขข้อมูลบริษัทสำเร็จ');
        
    }
}

