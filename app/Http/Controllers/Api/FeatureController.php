<?php

namespace App\Http\Controllers\Api;

use Image;
use App\Model\Page;
use App\Helper\Crop;
use App\Model\FeatureImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FeatureImageThumbnail;

class FeatureController extends Controller
{
    public function Upload(Request $request){
        $file = $request->file;
        $img = Image::make($file);  
        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $feature = "storage/uploads/page/feature/".$fname;
        Crop::crop(true,public_path("storage/uploads/page/feature/"),$fname,Image::make($file),1280,800,1);
        $featureimage = new FeatureImage();
        $featureimage->name = $feature;
        $featureimage->save();

        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $feature = "storage/uploads/page/feature/".$fname;
        Crop::crop(true,public_path("storage/uploads/page/feature/"),$fname,Image::make($file),1200,670,2);
        $featureimagethumbnail_1 = new FeatureImageThumbnail();
        $featureimagethumbnail_1->name = $feature;
        $featureimagethumbnail_1->save();

        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $feature = "storage/uploads/page/feature/".$fname;
        Crop::crop(true,public_path("storage/uploads/page/feature/"),$fname,Image::make($file),1000,1000,2);
        $featureimagethumbnail_2 = new FeatureImageThumbnail();
        $featureimagethumbnail_2->name = $feature;
        $featureimagethumbnail_2->save();


        return response()->json(
            array(
                "feature" => $featureimage,
                "bloglistimage" => $featureimagethumbnail_1,
                "bloghomepageimage" => $featureimagethumbnail_2
                ));  
    }


    public function Delete(Request $request){
        
        $featureimage = FeatureImage::find($request->featureid);
        
        @unlink($featureimage->name); 
        $featureimage->delete();

        $featureimagethumbnail = FeatureImageThumbnail::find($request->thumbnailid);
        @unlink($featureimagethumbnail->name); 
        $featureimagethumbnail->delete();

        Page::where('feature_image_id',$request->featureid)->update([
            'feature_image_id' => null
        ]);
        Page::where('feature_image_thumbnail_id',$request->thumbnailid)->update([
            'feature_image_thumbnail_id' => null
        ]);
        return response()->json(array("feature" => $request->featureid,"thumbnail" => $request->thumbnailid));  
    }

}
