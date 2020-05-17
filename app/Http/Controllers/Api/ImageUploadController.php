<?php

namespace App\Http\Controllers\Api;

use Image;
use App\Helper\Crop;
use App\Model\PageImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageUploadController extends Controller
{
    public function Upload(Request $request){
        $file = $request->file;
        $img = Image::make($file);  
        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $gallery = "storage/uploads/gallery/".$fname;
        Crop::crop(true,public_path("storage/uploads/gallery/"),$fname,Image::make($file),500,500,2);
        $pageimage = new PageImage();
        $pageimage->image = $gallery;
        $pageimage->save();
        
        $comming_array  = Array();
        if(count(json_decode($request->galleries))>0){
            foreach( json_decode($request->galleries) as $key => $tag ){
                $comming_array[] = $tag;
            } 
        }
        $comming_array[] = $pageimage->id;
        $gallerry = PageImage::whereIn('id', $comming_array)->get();
        return response()->json(array("image" =>  $pageimage,"gallergy" => $gallerry));  
    }

    public function Delete(Request $request){
        $comming_array  = Array();
        if(count(json_decode($request->galleries))>0){
            foreach( json_decode($request->galleries) as $key => $tag ){
                if($tag != $request->id){
                    $comming_array[] = $tag;
                }  
            } 
        }
        $pageiamge = PageImage::find($request->id);
        @unlink($pageiamge->image);  
        $pageiamge->delete();
        $gallerry = PageImage::whereIn('id', $comming_array)->get();
        return response()->json(array("id" => $request->id,"gallergy" => $gallerry));  
    }
}
