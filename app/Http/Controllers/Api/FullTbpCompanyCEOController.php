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
        $companyceo = new CompanyCeo();
        $companyceo->company_id = $company->id;
        $companyceo->name = $request->name;
        $companyceo->lastname = $request->lastname;
        $companyceo->position = $request->position;
        $companyceo->phone = $request->phone;
        $companyceo->workphone = $request->workphone;
        $companyceo->save();
        $companyceos = CompanyCeo::where('company_id',$company->id)->get();
        return response()->json($companyceos); 
    }

    public function Get(Request $request){      
        $ceo = CompanyCeo::find($request->id);
        return response()->json($ceo); 
    }

    public function Edit(Request $request){      
        CompanyCeo::find($request->id)->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'position' => $request->position,
            'phone' => $request->phone,
            'workphone' => $request->workphone,
        ]);
        $ceo = CompanyCeo::find($request->id);
        return response()->json($ceo); 
    }
}
