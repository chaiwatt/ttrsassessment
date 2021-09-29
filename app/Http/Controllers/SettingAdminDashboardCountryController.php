<?php

namespace App\Http\Controllers;

use App\Model\Country;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCountryRequest;

class SettingAdminDashboardCountryController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:0,4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $countries = Country::get();
        return view('setting.admin.dashboard.country.index')->withCountries($countries);
    }
    public function Create(){
        return view('setting.admin.dashboard.country.create');
    }
    public function CreateSave(CreateCountryRequest $request){
        $country = new Country();
        $country->name = $request->country;
        $country->save();
        return redirect()->route('setting.admin.dashboard.country')->withSuccess('เพิ่มประเทศสำเร็จ');
    }
    public function Edit($id){
        $country = Country::find($id);
        return view('setting.admin.dashboard.country.edit')->withCountry($country);
    }
    public function EditSave(CreateCountryRequest $request,$id){
        $country = Country::find($id)->update([
            'name' => $request->country
        ]);
        return redirect()->route('setting.admin.dashboard.country')->withSuccess('แก้ไขประเทศสำเร็จ');
    }
    public function Delete($id){
        Country::find($id)->delete();
        return redirect()->route('setting.admin.dashboard.country')->withSuccess('ลบรายการสำเร็จ');
    }
}
