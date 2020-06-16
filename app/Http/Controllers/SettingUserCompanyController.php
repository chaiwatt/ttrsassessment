<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use App\Helper\Crop;
use App\Model\Amphur;
use App\Model\Tambol;
use App\Helper\TinPin;
use App\Model\Company;
use App\Model\Province;
use App\Model\BusinessType;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\RegisteredCapitalType;
use App\Http\Requests\EditCompanyRequest;

class SettingUserCompanyController extends Controller
{
    public function Edit($userid){
        $user = User::find($userid);
        $registeredcapitaltypes = RegisteredCapitalType::get();
        $industrygroups = IndustryGroup::get();
        $businesstypes = BusinessType::get();
        $company = Company::where('user_id',$user->id)->first();
        $companyinfo = TinPin::tinpin($company->vatno);
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$company->province_id)->get();
        $tambols = Tambol::where('amphur_id',$company->amphur_id)->get();
        $registeredyear = substr(json_decode($companyinfo->getContent(), true)[0]['registerdateth'], -4);
        return view('setting.user.company.edit')->withCompany($company)
                                        ->withRegisteredcapitaltypes($registeredcapitaltypes)
                                        ->withIndustrygroups($industrygroups)
                                        ->withBusinesstypes($businesstypes)
                                        ->withAmphurs($amphurs)
                                        ->withTambols($tambols)
                                        ->withProvinces($provinces)
                                        ->withRegisteredyear($registeredyear);
    }

    public function EditSave(EditCompanyRequest $request, $id){
        $company = Company::find($id);
        $file = $request->picture; 
        $filelocation = $company->logo;
        if(!Empty($file)){         
            if(!Empty($company->logo)){
                @unlink($company->logo);
            }
            $name = $file->getClientOriginalName();
            $file = $request->picture;
            $img = Image::make($file);  
            $fname=str_random(10).".".$file->getClientOriginalExtension();
            $filelocation = "storage/uploads/company/".$fname;
            Crop::crop(true,public_path("storage/uploads/company/"),$fname,Image::make($file),500,500,1);
        }
        $company->update([
            'name' => $request->company,
            'registered_capital_type_id' => $request->registeredcapitaltype,
            'registeredyear' => $request->registeredyear,
            'registeredcapital' => $request->registeredcapital,
            'paidupcapital' => $request->paidupcapital,
            'paidupcapitaldate' => DateConversion::thaiToEngDate($request->paidupcapitaldate),
            'industry_group_id' => $request->industrygroup,
            'business_type_id' => $request->businesstype,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'email' => $request->email,
            'address' => $request->address,
            'province_id' => $request->province,
            'amphur_id' => $request->amphur,
            'tambol_id' => $request->tambol,
            'postalcode' => $request->postalcode,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'logo' => $filelocation
        ]);
        return redirect()->back()->withSuccess('แก้ไขข้อมูลบริษัทสำเร็จ'); 
    }
}

