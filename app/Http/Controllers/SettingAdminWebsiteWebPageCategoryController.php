<?php

namespace App\Http\Controllers;

use App\Model\WebPage;
use App\Helper\CreateSlug;
use Illuminate\Http\Request;

class SettingAdminWebsiteWebPageCategoryController extends Controller
{
    public function Index(){
        $webpages = WebPage::get();
        return view('setting.admin.website.webpage.index')->withWebpages($webpages);
    }

    public function Create(){
        return view('setting.admin.website.webpage.create');
    }

    public function CreateSave(Request $request){
        $page = new WebPage();
        $page->name = $request->title;
        $page->slug = CreateSlug::createSlug($request->title);
        $page->body = $request->body;
        $page->status = $request->status;
        $page->save();
        return redirect()->route('setting.admin.website.webpage')->withSuccess('เพิ่มหน้าเพจสำเร็จ');
    }

    public function Edit($id){
        $page = WebPage::find($id);
        return view('setting.admin.website.webpage.edit')->withPage($page);
    }

    public function EditSave(Request $request,$id){
        WebPage::find($id)->update([
            'name' => $request->title,
            'slug' => CreateSlug::createSlug($request->title),
            'body' => $request->body,
            'status' => $request->status,
        ]);
        return redirect()->route('setting.admin.website.webpage')->withSuccess('แก้ไขหน้าเพจสำเร็จ');
    }

    public function Delete($id){
        WebPage::find($id)->delete();
        return redirect()->route('setting.admin.website.webpage')->withSuccess('ลบหน้าเพจสำเร็จ');
    }

}
