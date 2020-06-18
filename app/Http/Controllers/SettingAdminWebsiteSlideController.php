<?php

namespace App\Http\Controllers;
use Image;
use App\Helper\Crop;
use App\Model\Slide;
use App\Model\SlideStyle;
use App\Model\SlideStatus;
use Illuminate\Http\Request;
use App\Http\Requests\EditWebsiteSlideRequest;
use App\Http\Requests\CreateWebsiteSlideRequest;

class SettingAdminWebsiteSlideController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $slides = Slide::get();
        return view('setting.admin.website.slide.index')->withSlides($slides);
    }
    public function Create(){
        $slidestatuses = SlideStatus::get();
        $slidestyles = SlideStyle::get();
        return view('setting.admin.website.slide.create')->withSlidestatuses($slidestatuses)
                                            ->withSlidestyles($slidestyles);
    }
    public function CreateSave(CreateWebsiteSlideRequest $request){
        $filelocation = '';
        $file = $request->picture;
        $img = Image::make($file);  
        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $filelocation = "storage/uploads/slide/".$fname;
        // $this->crop(true,public_path("storage/uploads/slide/"),$fname,Image::make($file),2300,1000,1);
        Crop::crop(true,public_path("storage/uploads/slide/"),$fname,Image::make($file),2300,1000,1);

        $slide = new Slide();
        $slide->name = $file->getClientOriginalName();
        $slide->slide_status_id = $request->slidestatus;
        $slide->slide_style_id = $request->slidestyle;
        $slide->textone = $request->textone;
        $slide->textengone = $request->textengone;
        $slide->texttwo = $request->texttwo;
        $slide->textengtwo = $request->textengtwo;
        $slide->textthree = $request->textthree;
        $slide->textengthree = $request->textengthree;
        $slide->url = $request->url;
        $slide->file = $filelocation;
        $slide->save();
        return redirect()->route('setting.admin.website.slide')->withSuccess('เพิ่มสไลด์สำเร็จ');
    }

    public function Edit($id){
        $slidestatuses = SlideStatus::get();
        $slidestyles = SlideStyle::get();
        $slide = Slide::find($id);
        return view('setting.admin.website.slide.edit')->withSlide($slide)
                                                    ->withSlidestatuses($slidestatuses)
                                                    ->withSlidestyles($slidestyles);
    }

    public function EditSave(EditWebsiteSlideRequest $request,$id){
        $file = $request->picture; 
        $slide = Slide::find($id);
        $filelocation = $slide->file;
        $name = $slide->name;
        if(!Empty($file)){   
            @unlink($slide->file);   
            $name = $file->getClientOriginalName();
            $file = $request->picture;
            $img = Image::make($file);  
            $fname=str_random(10).".".$file->getClientOriginalExtension();
            $filelocation = "storage/uploads/slide/".$fname;
            // $this->crop(true,public_path("storage/uploads/slide/"),$fname,Image::make($file),2300,1000,1);
            Crop::crop(true,public_path("storage/uploads/slide/"),$fname,Image::make($file),2300,1000,1);
        }
        $slide = Slide::find($id)->update([
            'slide_status_id' => $request->slidestatus,
            'slide_style_id' => $request->slidestyle,
            'textone' => $request->textone,
            'textengone' => $request->textengone,
            'texttwo' => $request->texttwo,
            'textengtwo' => $request->textengtwo,
            'textthree' => $request->textthree,
            'textengthree' => $request->textengthree,
            'url' => $request->url,
            'name' => $name,
            'file' => $filelocation
        ]);
        return redirect()->route('setting.admin.website.slide')->withSuccess('แก้ไขสไลด์สำเร็จ');
    }

    public function Delete($id){
        $slide = Slide::find($id);
        if(!Empty($slide->file)){
            @unlink($slide->file);  
        }
        Slide::find($id)->delete();
        return redirect()->route('setting.admin.website.slide')->withSuccess('ลบสไลด์สำเร็จ');
    }

    public function crop($isvertical,$path,$fname,$img,$width,$height,$offset){
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if($isvertical == true){
            $_width = $width*$offset; 
            $_height = $height*$offset; 
            $img->height() > $img->width() ? $_width=null : $_height=null;
            $img->resize($_width, $_height, function ($constraint) {
                $constraint->aspectRatio();
            })->crop($width, $height)->save($path.$fname);
        }else{
            $_width = $width*$offset; 
            $_height = $height*$offset; 
            $img->resize(null, $_height, function ($constraint) {
                $constraint->aspectRatio();
            })->crop($width, $height)->save($path.$fname);
        }
        return;
    }
}

