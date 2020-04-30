<?php

namespace App\Http\Controllers;

use App\Model\FaqCategory;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFaqCategoryRequest;

class SettingWebsiteFaqCategoryController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    public function Index(){
        $faqcategories = FaqCategory::get();
        return view('setting.website.faqcategory.index')->withFaqcategories($faqcategories);
    }
    public function Create(){
        return view('setting.website.faqcategory.create');
    }
    public function CreateSave(CreateFaqCategoryRequest $request){
        $faqcategory = new FaqCategory();
        $faqcategory->name = $request->faqcategory;
        $faqcategory->save();
        return redirect()->route('setting.website.faqcategory')->withSuccess('เพิ่มหมวดหมู่ faq สำเร็จ');
    }
    public function Edit($id){
        $faqcategory  = FaqCategory::find($id);
        return view('setting.website.faqcategory.edit')->withFaqcategory($faqcategory);
    }
    public function EditSave(CreateFaqCategoryRequest $request,$id){
        $faqcategory = FaqCategory::find($id)->update([
            'name' => $request->faqcategory
        ]);
        return redirect()->route('setting.website.faqcategory')->withSuccess('แก้ไขหมวดหมู่ faq สำเร็จ');
    }
    public function Delete($id){
        FaqCategory::find($id)->delete();
        return redirect()->route('setting.website.faqcategory')->withSuccess('ลบหมวดหมู่ faq สำเร็จ');
    }
}
