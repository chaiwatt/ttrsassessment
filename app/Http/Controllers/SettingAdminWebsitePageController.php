<?php

namespace App\Http\Controllers;
use Image;
use App\Model\Tag;
use App\Model\Menu;
use App\Model\Page;
use App\Model\PageTag;
use App\Model\PageStatus;
use App\Helper\CreateSlug;
use App\Model\PageCategory;
use Illuminate\Http\Request;
use App\Http\Requests\EditPageRequest;
use App\Http\Requests\CreatePageRequest;

class SettingAdminWebsitePageController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }

    public function Index(){
        $pages = Page::get();
        return view('setting.admin.website.page.index')->withPages($pages);
    }
    public function Create(){
        $pagecategories = PageCategory::get();
        $pagestatuses = PageStatus::get();
        $tags = Tag::get();
        $menus = Menu::get();
        return view('setting.admin.website.page.create')->withPagecategories($pagecategories)
                                                    ->withPagestatuses($pagestatuses)
                                                    ->withTags($tags)
                                                    ->withMenus($menus);
    }
    public function CreateSave(CreatePageRequest $request){
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$request->content);
        $images = $dom->getelementsbytagname('img');
        $detail = $dom->savehtml();

        $file = $request->feature;
        $img = Image::make($file);  
        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $feature = "storage/uploads/feature/".$fname;
        $this->crop(true,public_path("storage/uploads/feature/"),$fname,Image::make($file),1200,500,1);

        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $featurethumbnail = "storage/uploads/feature/".$fname;
        $this->crop(true,public_path("storage/uploads/feature/"),$fname,Image::make($file),550,412,1);

        $page = new Page();
        $page->page_category_id = $request->pagecategory;
        $page->page_status_id = $request->status;
        $page->name = $request->title;
        $page->slug = CreateSlug::createSlug($request->title);
        $page->header = $request->description;
        $page->content = $detail;
        $page->featureimg = $feature;
        $page->featurethumbnail = $featurethumbnail;
        $page->save();

        foreach ($request->pagetag as $key => $tag) {
            $pagetag = new PageTag();
            $pagetag->page_id = $page->id;
            $pagetag->tag = $tag;
            $pagetag->save(); 
        }
        if(!Empty($request->menu)){
            $menu = Menu::find($request->menu)->update([
                'page_id' => $page->id
            ]);
        }
        return redirect()->route('setting.admin.website.page')->withSuccess('เพิ่มหน้าเพจสำเร็จ');
    }

    public function Edit($id){
        $page = Page::find($id);
        $pagecategories = PageCategory::get();
        $pagestatuses = PageStatus::get();
        $tags = Tag::get();
        $menus = Menu::get();
        $pagetags = PageTag::where('page_id',$page->id)->get();
        return view('setting.admin.website.page.edit')->withPage($page)
                                                    ->withPagecategories($pagecategories)
                                                    ->withPagestatuses($pagestatuses)
                                                    ->withTags($tags)
                                                    ->withMenus($menus)
                                                    ->withPagetags($pagetags);
    }
    public function EditSave(EditPageRequest $request,$id){
        
        $file = $request->feature; 
        $page = Page::find($id);
        $feature = $page->featureimg;
        $featurethumbnail = $page->featurethumbnail;

        if(!Empty($file)){   
            @unlink($page->featureimg);   
            @unlink($page->featurethumbnail);  
            $img = Image::make($file);  

            $fname=str_random(10).".".$file->getClientOriginalExtension();
            $feature = "storage/uploads/feature/".$fname;
            $this->crop(true,public_path("storage/uploads/feature/"),$fname,Image::make($file),1200,500,1);
    
            $fname=str_random(10).".".$file->getClientOriginalExtension();
            $featurethumbnail = "storage/uploads/feature/".$fname;
            $this->crop(true,public_path("storage/uploads/feature/"),$fname,Image::make($file),550,412,1);
        }

        $page->update([
            'page_category_id' => $request->pagecategory,
            'page_status_id' => $request->status,
            'name' => $request->title,
            'slug' => CreateSlug::createSlug($request->title),
            'header' => $request->description, 
            'content' => $request->content, 
            'featureimg' => $feature, 
            'featurethumbnail' => $featurethumbnail
        ]);

        $comming_array  = Array();
        $existing_array  = Array();
        $unique_array  = Array();
        foreach( $request->pagetag as $key => $tag ){
            $comming_array[] = $tag;
        }

        PageTag::where('page_id',$id)->whereNotIn('tag',$comming_array)->delete();
        $existing_array = PageTag::where('page_id',$id)->pluck('tag')->toArray();
        $unique_array = array_diff($comming_array, $existing_array);
        // return $unique_array ; // array ที่เพิ่มเข้ามา

        foreach( $unique_array as $_tag ){
            $pagetag = new PageTag();
            $pagetag->page_id = $id;
            $pagetag->tag = $_tag;
            $pagetag->save(); 
        }

        return redirect()->route('setting.admin.website.page')->withSuccess('แก้ไขหน้าเพจสำเร็จ');
    }
    public function crop($isvertical,$path,$fname,$img,$width,$height,$offset){
        if (!file_exists($path)) {
            mkdir($path, 0666, true);
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
