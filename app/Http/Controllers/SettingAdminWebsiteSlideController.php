<?php

namespace App\Http\Controllers;

use App\Model\Slide;
use App\Model\SlideStyle;
use App\Model\SlideStatus;
use Illuminate\Http\Request;
use App\Http\Requests\CreateWebsiteSlideRequest;

class SettingAdminWebsiteSlideController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
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
        $file = $request->file('picture');
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/slide" , $new_name);
        $filelocation = "storage/uploads/slide/".$new_name;
        $slide = new Slide();
        $slide->name = $file->getClientOriginalName();
        $slide->slide_status_id = $request->slidestatus;
        $slide->slide_style_id = $request->slidestyle;
        $slide->textone = $request->textone;
        $slide->texttwo = $request->texttwo;
        $slide->textthree = $request->textthree;
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

    public function EditSave(CreateWebsiteSlideRequest $request,$id){
        $file = $request->picture; 
        $slide = Slide::find($id);
        if(!Empty($file)){    
            @unlink($slide->file);   
        }
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/slide" , $new_name);   
        $filelocation = "storage/uploads/slide/".$new_name;

        $slide = Slide::find($id)->update([
            'slide_status_id' => $request->slidestatus,
            'slide_style_id' => $request->slidestyle,
            'texttwo' => $request->texttwo,
            'texttwo' => $request->texttwo,
            'textthree' => $request->textthree,
            'url' => $request->url,
            'name' => $file->getClientOriginalName(),
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
}

