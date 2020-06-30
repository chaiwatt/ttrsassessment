<?php

namespace App\Http\Controllers\Api;

use Image;
use App\User;
use Illuminate\Http\Request;
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
        User::find(Auth::user()->id)->update([
            'signature' => 'storage/uploads/profile/signature/' .$new_name
        ]);
        $user = User::find(Auth::user()->id);
        return response()->json($user);  ;  
    }
    public function UploadSignature(Request $request){
        $file = $request->signature;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/profile/signature" , $new_name);
        $filelocation = "storage/uploads/profile/signature/".$new_name;
        User::find(Auth::user()->id)->update([
            'signature' => $filelocation
        ]);
        $user = User::find(Auth::user()->id);
        return response()->json($user); 
    }
}
