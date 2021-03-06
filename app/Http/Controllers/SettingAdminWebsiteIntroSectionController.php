<?php

namespace App\Http\Controllers;

use App\Model\IntroSection;
use Illuminate\Http\Request;
use App\Http\Requests\EditIntroSectionRequest;
use App\Http\Requests\CreateIntroSectionRequest;

class SettingAdminWebsiteIntroSectionController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
    }
    
    public function Index(){
        $introsections = IntroSection::get();
        return view('setting.admin.website.introsection.index')->withIntrosections($introsections);
    }
    public function Create(){
        return view('setting.admin.website.introsection.create');
    }
    public function CreateSave(CreateIntroSectionRequest $request){
        $filelocation = '';
        $file = $request->file('picture');
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/introsection" , $new_name);
        $filelocation = "storage/uploads/introsection/".$new_name;
        $introsection = new IntroSection();
        $introsection->text1 = $request->textone;
        $introsection->texteng1 = $request->textoneeng;
        $introsection->text2 = $request->texttwo;
        $introsection->texteng2 = $request->texttwoeng;
        $introsection->icon = $filelocation;
        $introsection->save();
        return redirect()->route('setting.admin.website.introsection')->withSuccess('เพิ่ม Intro section สำเร็จ');
    }
    public function Edit($id){
        $introsection = IntroSection::find($id);
        return view('setting.admin.website.introsection.edit')->withIntrosection($introsection);

    }
    public function EditSave(EditIntroSectionRequest $request,$id){
        $introsection = IntroSection::find($id);
        $filelocation = $introsection->icon; //พาร์ธไฟล์รูปเดิม
        $file = $request->file('picture'); //รูปใหม่

        if(!Empty($file)){
            @unlink($introsection->icon); //ถ้ามีไฟล์แนบมา ลบไฟล์เดิมทิ้ง
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/introsection" , $new_name);   
            $filelocation = "storage/uploads/introsection/".$new_name;
        }
        $introsection = IntroSection::find($id)->update([
            'text1' => $request->textone,
            'texteng1' => $request->textoneeng,
            'text2' => $request->texttwo,
            'texteng2' => $request->texttwoeng,       
            'icon' => $filelocation
        ]);
        return redirect()->route('setting.admin.website.introsection')->withSuccess('แก้ไข intro section สำเร็จ');
    }
    public function Delete($id){
        $introsection = IntroSection::find($id);
        if(!Empty($introsection->icon)){
            @unlink($introsection->icon);  
        }
        IntroSection::find($id)->delete();
        return redirect()->route('setting.admin.website.introsection')->withSuccess('ลบ intro section สำเร็จ');
    }

}
