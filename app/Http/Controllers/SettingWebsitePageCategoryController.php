<?php

namespace App\Http\Controllers;

use App\Helper\CreateSlug;
use App\Model\PageCategory;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePageCategoryRequest;

class SettingWebsitePageCategoryController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    public function Index(){
        $pagecategories = PageCategory::get();
        return view('setting.website.pagecategory.index')->withPagecategories($pagecategories);
    }
    public function Create(){
        return view('setting.website.pagecategory.create');
    }
    public function CreateSave(CreatePageCategoryRequest $request){
        $pagecategory = new PageCategory();
        $pagecategory->name = $request->pagecategory;
        $pagecategory->slug =CreateSlug::createslug($request->pagecategory);
        $pagecategory->save();
        return redirect()->route('setting.website.pagecategory')->withSuccess('เพิ่มหมวดหมู่เพจสำเร็จ');
    }
    public function Edit($id){
        $pagecategory = PageCategory::find($id);
        return view('setting.website.pagecategory.edit')->withPagecategory($pagecategory);
    }
    public function EditSave(CreatePageCategoryRequest $request,$id){
        $pagecategory = PageCategory::find($id)->update([
            'name' => $request->pagecategory,
            'slug' => CreateSlug::createslug($request->pagecategory)
        ]);
        return redirect()->route('setting.website.pagecategory')->withSuccess('ลบหมวดหมู่เพจสำเร็จ');
    }
}
