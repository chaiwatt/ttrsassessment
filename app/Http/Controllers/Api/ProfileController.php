<?php

namespace App\Http\Controllers\Api;

use Image;
use App\User;
use App\Model\Signature;
use App\Model\ExpertField;
use App\Model\UserPosition;
use App\Model\CompanyEmploy;
use Illuminate\Http\Request;
use App\Model\CompanyAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function UploadCanvasSignature(Request $request){
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

        return response()->json($signature);  
    }
    public function UploadSignature(Request $request){
        $file = $request->signature;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/profile/signature" , $new_name);
        $filelocation = "storage/uploads/profile/signature/".$new_name;
        // User::find(Auth::user()->id)->update([
        //     'signature' => $filelocation
        // ]);
        $signature = new Signature();
        $signature->path = $filelocation;
        $signature->save();
        // $user = User::find(Auth::user()->id);
        return response()->json($signature); 
    }
    public function AddUserPosition(Request $request){
        $userposition = new UserPosition();
        $userposition->name = $request->position;
        $userposition->save();
        $userpositions = UserPosition::get();
        return response()->json($userpositions); 
    }
    public function AddAddress(Request $request){
        $companyaddress = new CompanyAddress();
        $companyaddress->company_id = $request->id;
        $companyaddress->addresstype = $request->addressname;
        $companyaddress->address = $request->address;
        $companyaddress->province_id = $request->provincemodal;
        $companyaddress->amphur_id = $request->amphurmodal;
        $companyaddress->tambol_id = $request->tambolmodal;
        $companyaddress->postalcode = $request->postalcode;
        $companyaddress->lat = $request->lat;
        $companyaddress->lng = $request->lng;
        $companyaddress->save();
        $check = CompanyAddress::where('company_id',$request->id)->first();
        $companyaddresses = CompanyAddress::where('id','!=',$check->id)->where('company_id',$request->id)->get();
        return response()->json($companyaddresses); 
    }
    
    public function DeleteAddress(Request $request){
        $companyid = CompanyAddress::find($request->id)->company_id;
        CompanyAddress::find($request->id)->delete();
        $check = CompanyAddress::where('company_id',$companyid)->first();
        $companyaddresses = CompanyAddress::where('id','!=',$check->id)->where('company_id',$check->company_id)->get();
        return response()->json($companyaddresses); 
    }

    public function UpdateSignature(Request $request){
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

        CompanyEmploy::find($request->directorid)->update([
            'signature_id' => $signature->id
        ]);
        $companyemploy = CompanyEmploy::find($request->directorid);
        return response()->json($companyemploy); 
    }

    public function ReOrderOfficer(Request $request){
        $authid = Auth::user()->id;
        // dd($request->order);
   

              ExpertField::where('user_id',$authid)->delete();
        foreach($request->order as $key => $item){

            $arr = explode("-",$item);
            // preg_match_all("/[[^]]*]/", $arr[2], $matches);
            // var_dump($matches[0]);
            $temp = str_replace("[","",$arr[2]);
            $temp = str_replace("]","",$temp);
            //  echo( $authid  . ' ' . $arr[0] . ' ' . $arr[1]   . ' ' . $temp  . ' ' .($key+1).  '<br>');
            // ExpertField::where('user_id',$authid)->where('order',$arr[0])->where('id',$arr[1])->update([
            //     'order' => $key+1
            // ]);
            $new = new ExpertField();
            $new->user_id = $authid;
            $new->order = $key+1;
            $new->detail = @$temp;
            $new->save();
        }
        // dd();

        $expertfields = ExpertField::where('user_id',$authid)->orderBy('order','asc')->get();
        return response()->json($expertfields);  
        // dd();
    }
}
