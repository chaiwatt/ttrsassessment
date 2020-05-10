<?php

namespace App\Http\Controllers;

use App\Model\IntroSection;
use Illuminate\Http\Request;
use App\Http\Requests\CreateIntroSectionRequest;

class SettingAdminWebsiteIntroSectionController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
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
        $introsection->text2 = $request->texttwo;
        $introsection->icon = $filelocation;
        $introsection->save();
        return redirect()->route('setting.admin.website.introsection')->withSuccess('เพิ่ม Intro section สำเร็จ');
    }
    public function Edit($id){
        $introsection = IntroSection::find($id);
        return view('setting.admin.website.introsection.edit')->withIntrosection($introsection);

    }
    public function EditSave(CreateIntroSectionRequest $request,$id){
        $file = $request->picture; 
        $introsection = IntroSection::find($id);
        if(!Empty($file)){    
            @unlink($introsection->icon);   
        }
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/introsection" , $new_name);   
        $filelocation = "storage/uploads/introsection/".$new_name;

        $introsection = IntroSection::find($id)->update([
            'text1' => $request->textone,
            'text2' => $request->texttwo,
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
