<?php

namespace App\Http\Controllers;
use Image;
use App\Model\Tag;
use Carbon\Carbon;
use App\Model\Menu;
use App\Model\Page;
use App\Helper\Crop;
use App\Model\PageTag;
use App\Model\PageImage;
use App\Model\PageStatus;
use App\Helper\CreateSlug;
use App\Model\FeatureImage;
use App\Model\PageCategory;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
use App\Model\SummernoteImage;
use App\Helper\CreateDirectory;
use App\Model\FeatureImageThumbnail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditPageRequest;
use App\Http\Requests\CreatePageRequest;

class SettingAdminWebsitePageController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:4,5,6,7,8,9,10'); 
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
        $defaultpublicdate = Carbon::today()->format('d') . '/' . Carbon::today()->format('m') . '/' . (Carbon::today()->format('Y') + 543);
        return view('setting.admin.website.page.create')->withPagecategories($pagecategories)
                                                    ->withPagestatuses($pagestatuses)
                                                    ->withTags($tags)
                                                    ->withMenus($menus)
                                                    ->withDefaultpublicdate($defaultpublicdate);
    }
    public function CreateSave(CreatePageRequest $request){
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$request->content);
        CreateDirectory::CreateDirectory(public_path("storage/uploads/page/images/"));
        $images = $dom->getelementsbytagname('img');
        $imgarray = array();
        foreach($images as $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)= explode(',', $data);
            $data = base64_decode($data);
            $image_name= str_random(10).'.png';
            $imgarray[] = URL('')."/storage/uploads/page/images/".$image_name;
            $path = public_path() .'/storage/uploads/page/images/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', URL('')."/storage/uploads/page/images/".$image_name);
        }
        $detail = $dom->savehtml();

        $page = new Page();
        $page->page_category_id = $request->pagecategory;
        $page->page_status_id = $request->status;
        if(!Empty($request->publicdate)){
            $page->publicdate = DateConversion::thaiToEngDate($request->publicdate) ;
        }
        $page->name = $request->title;
        $page->slug = CreateSlug::createSlug($request->title);
        $page->header = $request->description;
        $page->content = $detail;
        $page->feature_image_id = $request->featureinp;
        $page->feature_image_thumbnail_id =  $request->featurethumbnail;
        $page->blogsidebarimage_id =  $request->blogsidebarimage;
        $page->bloghomepageimage_id =  $request->bloghomepageimage;


        $page->user_id = Auth::user()->id;
        $page->save();

        // foreach ($request->gal as $key => $gal) {
        //     PageImage::find($gal)->update([
        //         'page_id' => $page->id
        //     ]);
        // }

        // foreach($imgarray as $item){
        //     $summernoteimage = new SummernoteImage();
        //     $summernoteimage->page_id = $page->id;
        //     $summernoteimage->file = $item;
        //     $summernoteimage->save();
        // }

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

        // $pages = Page::get();
        // $sitemap = Sitemap::create();
        // foreach ($pages as $key => $page) {
        //     $sitemap->add(route('landing.page',['slug' => $page->slug]));
        // }
        // $sitemap->writeToFile(public_path('sitemap.xml'));
        //{{route('landing.page',['slug' => $page->slug])}}

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
        // return $request->publicdate;
        $detail=$request->content;
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$detail);
        $images = $dom->getelementsbytagname('img');
        $comming_array  = Array();
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            if(strpos($data, "data:image") !== false){
                list($type, $data) = explode(';', $data);
                list(, $data)= explode(',', $data);
                $data = base64_decode($data);
                $image_name= time().$k.'.png';
                $path = public_path() .'/storage/uploads/page/images/'. $image_name;
                $comming_array[] = URL('')."/storage/uploads/page/images/".$image_name;
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $img->setattribute('src', URL('')."/storage/uploads/page/images/".$image_name);
            }else{
                $comming_array[] =  $data ;
            }
        }

        $summerimgs = SummernoteImage::where('page_id',$id)->whereNotIn('file',$comming_array)->get();
        if ($summerimgs->count() > 0 ){
            foreach ($summerimgs as $summerimg){
             $url = str_replace(URL('').'/' , '' , $summerimg->file);
                unlink($url);
            }
            $summerimgs = SummernoteImage::where('page_id',$id)->whereNotIn('file',$comming_array)->delete();
        }
        
        $existing_array = SummernoteImage::where('page_id',$id)->pluck('file')->toArray();
        $unique_array = array_diff($comming_array, $existing_array);

        foreach($unique_array as $item){
            $summernoteimage = new SummernoteImage();
            $summernoteimage->page_id = $id;
            $summernoteimage->file = $item;
            $summernoteimage->save();
        }

        $file = $request->feature; 
        $page = Page::find($id);

        
        $detail = $dom->savehtml();

        // $exist_feature_image_id = $page->feature_image_id;
        // $exist_feature_image_thumbnail_id = $page->feature_image_thumbnail_id;

        // if(!Empty($page->feature_image_id)){
        //     $exist_feature_image_id = $request->featureinp;
        //     $exist_feature_image_thumbnail_id =  $request->featurethumbnailinp;
        // }

         

        $publicdate =  $page->publicdate;
        if(!Empty($request->publicdate)){
            $publicdate = DateConversion::thaiToEngDate($request->publicdate) ;
        }
        $page->update([
            'page_category_id' => $request->pagecategory,
            'page_status_id' => $request->status,
            'name' => $request->title,
            'slug' => CreateSlug::createSlug($request->title),
            'header' => $request->description, 
            'publicdate' => $publicdate, 
            'content' => $detail, 
            'feature_image_id' => $request->featureinp, 
            'feature_image_thumbnail_id' => $request->featurethumbnail
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

        // foreach ($request->gal as $key => $gal) {
        //     PageImage::find($gal)->update([
        //         'page_id' => $page->id
        //     ]);
        // }


        // $pages = Page::get();

        // $sitemap = App::make("sitemap");

        // foreach ($pages as $key => $page) {
        //     $sitemap->add(route('landing.page',['slug' => $page->slug]), $page->updated_at, '1.0', 'daily');
        // }
        // $sitemap->store('xml', 'sitemap');
        return redirect()->route('setting.admin.website.page')->withSuccess('แก้ไขหน้าเพจสำเร็จ');
    }
 
    public function Delete($id){
        $page = Page::find($id);
        if(!Empty($page->feature_image_id)){
            $featureimage = FeatureImage::find($page->feature_image_id);
            @unlink($featureimage->name);  
            $featureimage->delete(); 
        }
        if(!Empty($page->feature_image_thumbnail_id)){
            $featureimagethumbnail = FeatureImageThumbnail::find($page->feature_image_thumbnail_id);
            @unlink($featureimagethumbnail->name); 
            $featureimagethumbnail->delete(); 
        }
        $pageimages = PageImage::where('page_id',$page->id)->get();
        foreach ($pageimages as $pageimage) {
            @unlink($pageimage->image);
        }
        PageImage::where('page_id',$page->id)->delete();
        $page->delete();
        return redirect()->route('setting.admin.website.page')->withSuccess('ลบหน้าเพจสำเร็จ');
    }

}
