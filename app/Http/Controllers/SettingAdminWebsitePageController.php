<?php

namespace App\Http\Controllers;
use Image;
use App\Model\Tag;
use App\Model\Menu;
use App\Model\Page;
use App\Helper\Crop;
use App\Model\PageTag;
use App\Model\PageImage;
use App\Model\PageStatus;
use App\Helper\CreateSlug;
use App\Model\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        Crop::crop(true,public_path("storage/uploads/feature/"),$fname,Image::make($file),1200,500,1);

        $fname=str_random(10).".".$file->getClientOriginalExtension();
        $featurethumbnail = "storage/uploads/feature/".$fname;
        Crop::crop(true,public_path("storage/uploads/feature/"),$fname,Image::make($file),550,412,2);

        $page = new Page();
        $page->page_category_id = $request->pagecategory;
        $page->page_status_id = $request->status;
        $page->name = $request->title;
        $page->slug = CreateSlug::createSlug($request->title);
        $page->header = $request->description;
        $page->content = $detail;
        $page->featureimg = $feature;
        $page->featurethumbnail = $featurethumbnail;
        $page->user_id = Auth::user()->id;
        $page->save();

        foreach ($request->pagetag as $key => $tag) {
            $pagetag = new PageTag();
            $pagetag->page_id = $page->id;
            $pagetag->tag_id = $tag;
            $pagetag->save(); 
        }
        if(!Empty($request->menu)){
            $menu = Menu::find($request->menu)->update([
                'page_id' => $page->id
            ]);
        }
        if(!Empty($request->gallery)){
            foreach($request->gallery as $gallery){
                $file = $gallery;
                $img = Image::make($file);  
                $fname=str_random(10).".".$file->getClientOriginalExtension();
                $_gallery = "storage/uploads/gallery/".$fname;
                // $this->crop(true,public_path("storage/uploads/gallery/"),$fname,Image::make($file),1000,1000,1);
                Crop::crop(true,public_path("storage/uploads/gallery/"),$fname,Image::make($file),1000,1000,1);
                $pageimage = new PageImage();
                $pageimage->page_id = $page->id;
                $pageimage->image = $_gallery;
                $pageimage->save();
            }
        }

        return redirect()->route('setting.admin.website.page')->withSuccess('เพิ่มหน้าเพจสำเร็จ');
    }

    public function Edit($id){
        $page = Page::find($id);
        $pagecategories = PageCategory::get();
        $pagestatuses = PageStatus::get();
        $tags = Tag::get();
        $menus = Menu::get();
        $pagetags = PageTag::where('page_id',$id)->get();
        $pageimages = PageImage::where('page_id',$id)->get();
        return view('setting.admin.website.page.edit')->withPage($page)
                                                    ->withPagecategories($pagecategories)
                                                    ->withPagestatuses($pagestatuses)
                                                    ->withTags($tags)
                                                    ->withMenus($menus)
                                                    ->withPagetags($pagetags)
                                                    ->withPageimages($pageimages);
    }
    public function EditSave(EditPageRequest $request,$id){
        ini_set('memory_limit', '256M');
        ini_set('upload_max_filesize','40M');
        ini_set('post_max_size','40M'); 
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
            Crop::crop(true,public_path("storage/uploads/feature/"),$fname,Image::make($file),1200,500,1);
            $fname=str_random(10).".".$file->getClientOriginalExtension();
            $featurethumbnail = "storage/uploads/feature/".$fname;
            Crop::crop(true,public_path("storage/uploads/feature/"),$fname,Image::make($file),550,412,1);
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

        PageTag::where('page_id',$id)->whereNotIn('tag_id',$comming_array)->delete();
        $existing_array = PageTag::where('page_id',$id)->pluck('tag_id')->toArray();
        $unique_array = array_diff($comming_array, $existing_array);

        foreach( $unique_array as $_tag ){
            $pagetag = new PageTag();
            $pagetag->page_id = $id;
            $pagetag->tag_id = $_tag;
            $pagetag->save(); 
        }

        if(!Empty($request->gallery)){
            foreach($request->gallery as $gallery){
                $file = $gallery;
                $img = Image::make($file);  
                $fname=str_random(10).".".$file->getClientOriginalExtension();
                $_gallery = "storage/uploads/gallery/".$fname;
                Crop::crop(true,public_path("storage/uploads/gallery/"),$fname,Image::make($file),1000,1000,1);
                $pageimage = new PageImage();
                $pageimage->page_id = $page->id;
                $pageimage->image = $_gallery;
                $pageimage->save();
            }
        }

        return redirect()->route('setting.admin.website.page')->withSuccess('แก้ไขหน้าเพจสำเร็จ');
    }
 
    public function Delete($id){
        $page = Page::find($id);
        if(!Empty($page->featureimg)){
            @unlink($page->featureimg);   
        }
        if(!Empty($page->featurethumbnail)){
            @unlink($page->featurethumbnail); 
        }
        $page->delete();
        return redirect()->route('setting.admin.website.page')->withSuccess('ลบหน้าเพจสำเร็จ');
    }

}
