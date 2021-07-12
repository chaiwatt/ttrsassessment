<?php

namespace App\Http\Controllers\Api;
use Image;
use App\Model\Prefix;
use App\Model\Company;
use App\Model\IsicSub;
use App\Model\Signature;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\EmployPosition;
use App\Model\AuthorizedDirector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function GetSubisic(Request $request){
        $subisics = IsicSub::where('isic_id',$request->id)->get();
        $company = Company::where('user_id',Auth::user()->id)->first();
        return response()->json(array(
            "subisics" => $subisics,
            "company" => $company
        ));
    }

    public function AddAuthorizedDirector(Request $request){
        $otherposition = '';
        $otherprefix = '';
        if(!Empty($request->otherposition)){
            $otherposition = $request->otherposition;
        }
        if(!Empty($request->otherprefix)){
            $otherprefix = $request->otherprefix;
        }
        $companyemploy = new CompanyEmploy();
        $companyemploy->company_id = $request->id;
        $companyemploy->prefix_id = $request->prefix;
        $companyemploy->otherprefix = $otherprefix;
        $companyemploy->name = $request->name;
        $companyemploy->lastname = $request->lastname;
        $companyemploy->employ_position_id = $request->position;
        $companyemploy->otherposition = $otherposition;
        // $companyemploy->signature_id = $request->signature;
        $companyemploy->save();
        

        if(!Empty($request->signaturebase64)){
            $base64 = $request->signaturebase64;   
            $new_name = time().'.'.explode('/',explode(':',substr($base64,0,strpos($base64,';')))[1])[1];
            $imgpath = public_path("storage/uploads/profile/signature/");
            if (!file_exists($imgpath)) {
                mkdir($imgpath, 0777, true);
            }
            Image::make($base64)->save($imgpath.$new_name);
            $signature = new Signature();
            $signature->path = 'storage/uploads/profile/signature/' .$new_name;
            $signature->save();

            $companyemploy->update([
                'signature_id' => $signature->id
            ]);
        }

        $companyemploys = CompanyEmploy::where('company_id',$request->id)->where('employ_position_id', '<=',5)->orderBy('id','desc')->get();
        return response()->json($companyemploys);
    }
    public function DeleteAuthorizedDirector(Request $request){
        $signature = CompanyEmploy::find($request->id)->signature_id;
      
            if(!Empty($signature)){
                @unlink(Signature::find($signature)->path);
                $check = Signature::find($signature);
                if(!Empty($check)){
                    @Signature::find($signature)->delete();
                }
                
            }
        $companyid = CompanyEmploy::find($request->id)->company_id;
        CompanyEmploy::find($request->id)->delete();
        $companyemploys = CompanyEmploy::where('company_id',$companyid)->where('employ_position_id', '<=',5)->orderBy('id','desc')->get();
        return response()->json($companyemploys);
    }
    public function UploadOrganizeImg(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/company/attachment" , $new_name);
        $filelocation = "storage/uploads/company/attachment/".$new_name;
        Company::find($request->id)->update([
            'organizeimg' => $filelocation
        ]);

        $company = Company::find($request->id);
        return response()->json($company); 
    }
    
    public function GetAuthorizedDirector(Request $request){
        $signature = '';
        $employpositions = EmployPosition::where('id', '<=',5)->get();
        $companyemploy = CompanyEmploy::find($request->id);
        $prefixes = Prefix::get();
        if(!Empty($companyemploy->signature_id)){
            $signature = Signature::find($companyemploy->signature_id)->path;
        }
        
        return response()->json(array(
            "companyemploy" => $companyemploy,
            "employpositions" => $employpositions,
            "prefixes" => $prefixes,
            '$signature' => $signature
        ));
    }

    public function EditAuthorizedDirector(Request $request){
        $otherposition = '';
        $otherprefix = '';
        if(!Empty($request->otherposition)){
            $otherposition = $request->otherposition;
        }
        if(!Empty($request->otherprefix)){
            $otherprefix = $request->otherprefix;
        }
        $employ = CompanyEmploy::find($request->id);//->signature_id;
        // if(!Empty($request->signature)){
        //     if(!Empty($signature)){
        //         unlink(Signature::find($signature)->path);
        //         Signature::find($signature)->delete();
        //     }
        //     $signature = $request->signature;
        // }

        if(!Empty($request->signaturebase64)){
            if(!Empty($employ->signature_id)){
                @unlink(Signature::find($employ->signature_id)->path);
                Signature::find($employ->signature_id)->delete();
            }
            // $signature = $request->signature;
            $base64 = $request->signaturebase64;   
            $new_name = time().'.'.explode('/',explode(':',substr($base64,0,strpos($base64,';')))[1])[1];
            $imgpath = public_path("storage/uploads/profile/signature/");
            if (!file_exists($imgpath)) {
                mkdir($imgpath, 0777, true);
            }
            Image::make($base64)->save($imgpath.$new_name);
            $signature = new Signature();
            $signature->path = 'storage/uploads/profile/signature/' .$new_name;
            $signature->save();

            // $companyemploy->update([
                // 'signature_id' => $signature->id
            // ]);
            CompanyEmploy::find($request->id)->update([
                'signature_id' => $signature->id
            ]);
        }

        CompanyEmploy::find($request->id)->update([
            'prefix_id' => $request->prefix,
            'otherprefix' => $otherprefix,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'employ_position_id' => $request->position,
            'otherposition' => $otherposition,
            // 'signature_id' => $signature
        ]);
        $companyid = CompanyEmploy::find($request->id)->company_id;
        $companyemploys = CompanyEmploy::where('company_id',$companyid)->where('employ_position_id', '<=',5)->orderBy('id','desc')->get();
        return response()->json($companyemploys);
    }
}

