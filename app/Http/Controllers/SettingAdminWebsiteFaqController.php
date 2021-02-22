<?php

namespace App\Http\Controllers;

use App\Model\Faq;
use App\Model\PageStatus;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFaqRequest;

class SettingAdminWebsiteFaqController extends Controller
{
    public function Index(){
        $faqs = Faq::orderBy('id','desc')->get();
        return view('setting.admin.website.faq.index')->withFaqs($faqs);
    }
    public function Create(){
        $statuses = PageStatus::get();
        return view('setting.admin.website.faq.create')->withStatuses($statuses);
    }
    public function CreateSave(CreateFaqRequest $request){
        $faq = new Faq();
        $faq->title = $request->title;
        $faq->body = $request->body;
        $faq->status = $request->status;
        $faq->save();
        return redirect()->route('setting.admin.website.faq')->withSuccess('เพิ่มคำถามที่พบบ่อยสำเร็จ');
    }
    public function Edit($id){
        $faq = Faq::find($id);
        $statuses = PageStatus::get();
        return view('setting.admin.website.faq.edit')->withStatuses($statuses)
                                                    ->withFaq($faq);
    }
    public function EditSave(CreateFaqRequest $request,$id){
        Faq::find($id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status
        ]);
        return redirect()->route('setting.admin.website.faq')->withSuccess('แก้ไขคำถามที่พบบ่อยสำเร็จ');
    }
    public function Delete($id){
        Faq::find($id)->delete();
        return redirect()->route('setting.admin.website.faq')->withSuccess('ลบคำถามที่พบบ่อยสำเร็จ');
    }
}
