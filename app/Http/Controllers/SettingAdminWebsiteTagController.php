<?php

namespace App\Http\Controllers;

use App\Model\Tag;
use App\Helper\CreateSlug;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTagRequest;

class SettingAdminWebsiteTagController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:0,4,5,6,7,8,9,10'); 
    }
    public function Index(){
        $tags = Tag::get();
        return view('setting.admin.website.tag.index')->withTags($tags);
    }
    public function Create(){
        return view('setting.admin.website.tag.create');
    }
    public function CreateSave(CreateTagRequest $request){
        $tag = new Tag();
        $tag->name = $request->tag;
        $tag->slug = CreateSlug::createSlug($request->tag) ;
        $tag->save();
        return redirect()->route('setting.admin.website.tag')->withSuccess('เพิ่มป้ายกำกับเพจสำเร็จ');
    }
    public function Edit($id){
        $tag  = Tag::find($id);
        return view('setting.admin.website.tag.edit')->withTag($tag);
    }
    public function EditSave(CreateTagRequest $request,$id){
        $tag = Tag::find($id)->update([
            'name' => $request->tag,
            'slug' => CreateSlug::createSlug($request->tag) 
        ]);
        return redirect()->route('setting.admin.website.tag')->withSuccess('แก้ไขป้ายกำกับเพจสำเร็จ');
    }
    public function Delete($id){
        Tag::find($id)->delete();
        return redirect()->route('setting.admin.website.tag')->withSuccess('ลบป้ายกำกับเพจสำเร็จ');
    }
}
