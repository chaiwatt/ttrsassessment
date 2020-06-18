<?php

namespace App\Http\Controllers;

use App\Helper\CreateSlug;
use App\Model\PageCategory;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePageCategoryRequest;

class SettingAdminWebsitePageCategoryController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $pagecategories = PageCategory::get();
        return view('setting.admin.website.pagecategory.index')->withPagecategories($pagecategories);
    }
    public function Create(){
        $pagecategories = PageCategory::where('parent_id',0)->get();
        $allpagecategories = PageCategory::pluck('name','id')->all();
        return view('setting.admin.website.pagecategory.create')->withPagecategories($pagecategories)
                                                            ->withAllpagecategories($allpagecategories);
    }
    public function CreateSave(CreatePageCategoryRequest $request){
        $pagecategory = new PageCategory();
        $pagecategory->name = $request->pagecategory;
        $pagecategory->slug =CreateSlug::createslug($request->pagecategory);
        $pagecategory->save();
        return redirect()->route('setting.admin.website.pagecategory')->withSuccess('เพิ่มหมวดหมู่เพจสำเร็จ');
    }
    public function Edit($id){
        $pagecategory = PageCategory::find($id);
        return view('setting.admin.website.pagecategory.edit')->withPagecategory($pagecategory);
    }
    public function EditSave(CreatePageCategoryRequest $request,$id){
        $pagecategory = PageCategory::find($id)->update([
            'name' => $request->pagecategory,
            'slug' => CreateSlug::createslug($request->pagecategory)
        ]);
        return redirect()->route('setting.admin.website.pagecategory')->withSuccess('ลบหมวดหมู่เพจสำเร็จ');
    }
    public function Crud(CreatePageCategoryRequest $request){
        if($request->action == 'create'){
            $parentid = 0;
            if(!Empty($request->parentcategory)){
                $parentid = $request->parentcategory;
            }
            $pagecategory = new PageCategory();
            $pagecategory->parent_id = $parentid;
            $pagecategory->name = $request->category;
            $pagecategory->slug = CreateSlug::createSlug($request->category);
            $pagecategory->save();
            return redirect()->back()->withSuccess('เพิ่มหมวดหมู่สำเร็จ');
        }else if($request->action == 'edit'){
            if(!Empty($request->categoryid)){
                PageCategory::find($request->categoryid)->update([
                    'parent_id' => $request->parentcategory,
                    'name' => $request->category,
                    'slug' => CreateSlug::createSlug($request->category),
                ]);
                return redirect()->back()->withSuccess('แก้ไขหมวดหมู่สำเร็จ');
            }else{
                return redirect()->back()->withError('ยังไม่ได้เลือกหมวดหมู่');
            }
        }else if($request->action == 'delete'){
            if(!Empty($request->categoryid)){
                if(PageCategory::where('parent_id',$request->categoryid)->get()->count() > 0){
                    return redirect()->back()->withError('ไม่สามารถลบหมวดหมู่ที่มีหมวดหมู่ย่อย');
                }
                PageCategory::find($request->categoryid)->delete();
                return redirect()->back()->withSuccess('ลบหมวดหมู่สำเร็จ');
            }else{
                return redirect()->back()->withError('ยังไม่ได้เลือกหมวดหมู่');
            }
        }   
    }
}
