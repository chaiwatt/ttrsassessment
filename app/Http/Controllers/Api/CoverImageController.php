<?php

namespace App\Http\Controllers\Api;

use Image;
use App\User;
use App\Helper\Crop;
use App\Model\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CoverImageController extends Controller
{
    public function Add(Request $request){
        $file = $request->file;
        $img = Image::make($file);  
        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $cover = "storage/uploads/profile/cover/".$fname;
        Crop::crop(true,public_path("storage/uploads/profile/cover/"),$fname,Image::make($file),1500,572,1);
        $auth = Auth::user();
        if(!Empty($auth->cover)){
            @unlink($auth->cover);
        }
        $auth->update([
            'cover' => $cover
        ]);
        $auth = Auth::user()->makeHidden('fulltbpexpert')->makeHidden('fulltbpofficer')->makeHidden('usertype');
        return response()->json($auth);  
    }
    
    public function AddAvatar(Request $request){
        $file = $request->file;
        $img = Image::make($file);  
        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $picture = "storage/uploads/profile/user/".$fname;
        Crop::crop(true,public_path("storage/uploads/profile/user/"),$fname,Image::make($file),550,550,1);
        $auth = Auth::user();
        if(!Empty($auth->picture)){
            @unlink($auth->picture);
        }
        $auth->update([
            'picture' => $picture
        ]);
        // $auth = Auth::user()->makeHidden('fulltbpexpert')->makeHidden('fulltbpofficer')->makeHidden('usertype');
        $auth = Auth::user();
        //gzencode
        return response()->json($auth);  
    }
}
