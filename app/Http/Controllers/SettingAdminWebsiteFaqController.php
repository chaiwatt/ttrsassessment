<?php

namespace App\Http\Controllers;

use App\Model\Faq;
use App\HomePageSection;
use App\Model\PageStatus;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFaqRequest;

class SettingAdminWebsiteFaqController extends Controller
{
    public function Index(){
        $homepagesection = HomePageSection::where('order_list',5)->first();
        $faqs = Faq::orderBy('id','desc')->get();
        return view('setting.admin.website.homepage.faq.index')->withFaqs($faqs)->withHomepagesection($homepagesection);
    }
    public function Create(){
        $statuses = PageStatus::get();
        return view('setting.admin.website.homepage.faq.create')->withStatuses($statuses);
    }
    public function CreateSave(CreateFaqRequest $request){
        $faq = new Faq();
        $faq->title = $request->title;
        $faq->body = $request->body;
        $faq->titleeng = $request->titleeng;
        $faq->bodyeng = $request->bodyeng;
        $faq->status = $request->status;
        
        $faq->save();
        return redirect()->route('setting.admin.website.homepage.faq')->withSuccess('เพิ่มคำถามที่พบบ่อยสำเร็จ');
    }
    public function Edit($id){
        $faq = Faq::find($id);
        $statuses = PageStatus::get();
        
        return view('setting.admin.website.homepage.faq.edit')->withStatuses($statuses)
                                                    ->withFaq($faq);
    }
    public function EditSave(CreateFaqRequest $request,$id){
        Faq::find($id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'titleeng' => $request->titleeng,
            'bodyeng' => $request->bodyeng,
            'status' => $request->status
        ]);
        return redirect()->route('setting.admin.website.homepage.faq')->withSuccess('แก้ไขคำถามที่พบบ่อยสำเร็จ');
    }
    public function Delete($id){
        Faq::find($id)->delete();
        return redirect()->route('setting.admin.website.homepage.faq')->withSuccess('ลบคำถามที่พบบ่อยสำเร็จ');
    }

    public function EditSaveStatus(Request $request){
        HomePageSection::where('order_list',5)->first()->update([
            'show' => $request->status
        ]);
        return redirect()->route('setting.admin.website.homepage.faq')->withSuccess('แก้ไขรายการสำเร็จ');
    }
}
