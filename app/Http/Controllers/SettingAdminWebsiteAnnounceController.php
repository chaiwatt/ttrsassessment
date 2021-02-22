<?php

namespace App\Http\Controllers;

use App\Model\Announce;
use App\Model\PageStatus;
use App\Helper\CreateSlug;
use Illuminate\Http\Request;
use App\Model\AnnounceCategory;
use App\Model\AnnounceAttachment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAnnounceRequest;

class SettingAdminWebsiteAnnounceController extends Controller
{
    public function Index(){
        $announces = Announce::get();
        return view('setting.admin.website.announce.index')->withAnnounces($announces);
    }

    public function Create(){
        $announcecategories = AnnounceCategory::get();
        $pagestatuses = PageStatus::get();
        return view('setting.admin.website.announce.create')->withAnnouncecategories($announcecategories)
                                                            ->withPagestatuses($pagestatuses);
    }

    public function Upload(Request $request){
        $file = $request->file;
        $new_name = str_random(10).".".$file->getClientOriginalExtension();
        $file->move("storage/uploads/announce/attachment" , $new_name);
        $filelocation = "storage/uploads/announce/attachment/".$new_name;

        $announceattachment = new AnnounceAttachment();
        $announceattachment->name = $request->announceattachmentname;
        $announceattachment->path = $filelocation;
        $announceattachment->save();

        $comming_array  = Array();
        if(count(json_decode($request->inpattachments))>0){
            foreach( json_decode($request->inpattachments) as $key => $item ){
                $comming_array[] = $item;
            } 
        }
        $comming_array[] = $announceattachment->id;
        $announceattachments = AnnounceAttachment::whereIn('id', $comming_array)->get();
        return response()->json(array("file" => $announceattachment,"announceattachments" => $announceattachments));  
    }

    
    public function DeleteAttachment(Request $request){
        $comming_array  = Array();
        if(count(json_decode($request->inpattachments))>0){
            foreach( json_decode($request->inpattachments) as $key => $item ){
                if($item != $request->id){
                    $comming_array[] = $item;
                }  
            } 
        }
        $announceattachment = AnnounceAttachment::find($request->id);
        @unlink($announceattachment->path);  
        $announceattachment->delete();
        $announceattachments = AnnounceAttachment::whereIn('id', $comming_array)->get();
        return response()->json(array("id" => $request->id,"announceattachments" => $announceattachments));  
    }

    public function CreateSave(CreateAnnounceRequest $request){
        $announce = new Announce();
        $announce->announce_category_id = $request->announcecategory;
        $announce->title = $request->title;
        $announce->slug = CreateSlug::createSlug($request->title) ;
        $announce->content = $request->content;
        $announce->page_status_id = $request->status;
        $announce->user_id = Auth::user()->id;
        $announce->save();

        if(!Empty($request->input_attachment)){
            foreach ($request->input_attachment as $attachment) {
                AnnounceAttachment::find($attachment)->update([
                    'announce_id' => $announce->id
                ]);
            }
        }
        return redirect()->route('setting.admin.website.announce')->withSuccess('เพิ่มประกาศสำเร็จ');
    }

    public function Edit($id){
        $announcecategories = AnnounceCategory::get();
        $announce = Announce::find($id);
        $announceattachments = AnnounceAttachment::where('announce_id',$id)->get();
        $pagestatuses = PageStatus::get();
        return view('setting.admin.website.announce.edit')->withAnnounce($announce)
                                                            ->withAnnounceattachments($announceattachments)
                                                            ->withPagestatuses($pagestatuses)
                                                            ->withAnnouncecategories($announcecategories);
    }
    public function EditSave(CreateAnnounceRequest $request,$id){
        Announce::find($id)->update([
            'announce_category_id' => $request->announcecategory,
            'title' => $request->title,
            'slug' => CreateSlug::createSlug($request->title),
            'content' => $request->content,
            'page_status_id' => $request->status
        ]);

        if(!Empty($request->input_attachment)){
            $notinannounceattachments = AnnounceAttachment::where('announce_id',$request->id)->whereNotIn('id',$request->input_attachment)->get();
            if($notinannounceattachments->count() > 0){
                foreach ($notinannounceattachments as $key => $notinannounceattachment) {
                    @unlink($notinannounceattachment->path);
                }
            }
            AnnounceAttachment::where('announce_id',$request->id)->whereNotIn('id',$request->input_attachment)->delete();
            foreach ($request->input_attachment as $attachment) {
                AnnounceAttachment::find($attachment)->update([
                    'announce_id' => $id
                ]);
            }
        }else{
            AnnounceAttachment::where('announce_id',$request->id)->delete();
        }
        return redirect()->route('setting.admin.website.announce')->withSuccess('แก้ไขประกาศสำเร็จ');
    }
    public function Delete($id){
        $announceattachments = AnnounceAttachment::where('announce_id',$id)->get();
        if($announceattachments->count() > 0){
            foreach ($announceattachments as $key => $announceattachment) {
                @unlink($announceattachment->path);
            }
        }
        AnnounceAttachment::where('announce_id',$id)->delete();
        $announce = Announce::where('id',$id)->delete();
        return redirect()->route('setting.admin.website.announce')->withSuccess('ลบประกาศสำเร็จ');
    }
}
