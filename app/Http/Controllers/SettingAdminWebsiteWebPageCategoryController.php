<?php

namespace App\Http\Controllers;

use App\Model\WebPage;
use App\Helper\CreateSlug;
use Illuminate\Http\Request;
use App\Model\SummernoteImage;
use App\Helper\CreateDirectory;

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
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$request->body);
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

        $page = new WebPage();
        $page->name = $request->title;
        $page->slug = CreateSlug::createSlug($request->title);
        $page->body = $detail; //$request->body;
        $page->status = $request->status;
        $page->save();
        return redirect()->route('setting.admin.website.webpage')->withSuccess('เพิ่มหน้าเพจสำเร็จ');

    }

    public function Edit($id){
        $page = WebPage::find($id);
        return view('setting.admin.website.webpage.edit')->withPage($page);
    }

    public function EditSave(Request $request,$id){
        $detail=$request->body;
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

   
        $detail = $dom->savehtml();


        WebPage::find($id)->update([
            'name' => $request->title,
            'slug' => CreateSlug::createSlug($request->title),
            'body' => $detail ,//$request->body,
            'status' => $request->status,
        ]);
        return redirect()->route('setting.admin.website.webpage')->withSuccess('แก้ไขหน้าเพจสำเร็จ');
    }

    public function Delete($id){
        WebPage::find($id)->delete();
        return redirect()->route('setting.admin.website.webpage')->withSuccess('ลบหน้าเพจสำเร็จ');
    }

}
