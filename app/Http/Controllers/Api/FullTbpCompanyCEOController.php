<?php

namespace App\Http\Controllers\Api;

use App\Model\Company;
use App\Model\CompanyCeo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FullTbpCompanyCEOController extends Controller
{
    public function Add(Request $request){      
        $company = Company::where('user_id',Auth::user()->id)->first();
        $check = CompanyCeo::where('company_id',$company->id)->first();
        if(Empty($check)){
            $companyceo = new CompanyCeo();
            $companyceo->company_id = $company->id;
            $companyceo->name = $request->name;
            $companyceo->lastname = $request->lastname;
            $companyceo->save();
        }else{
            CompanyCeo::where('company_id',$company->id)->first()->update([
                'name' => $request->name,
                'lastname' => $request->lastname,
            ]);
        }
        $companyceo = CompanyCeo::where('company_id',$company->id)->first();
        return response()->json($companyceo); 
    }
}
