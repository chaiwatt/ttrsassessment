<?php

namespace App\Http\Controllers;

use App\Model\Announce;
use App\Model\PageStatus;
use App\Helper\CreateSlug;
use Illuminate\Http\Request;
use App\Model\AnnounceCategory;
use App\Model\AnnounceAttachment;

class SettingAdminWebsiteAnnounceController extends Controller
{
    public function Index(){
        return view('setting.admin.website.announce.index');
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

    public function CreateSave(Request $request){

        $announce = new Announce();
        $announce->announce_category_id = $request->announcecategory;
        $announce->title = $request->title;
        $announce->slug = CreateSlug::createSlug($request->title) ;
        $announce->content = $request->content;
        $announce->page_status_id = $request->status;
        $announce->save();

        if(!Empty($request->input_attachment)){
            foreach ($request->input_attachment as $attachment) {
                AnnounceAttachment::find($attachment)->update([
                    'announce_id' => $announce->id
                ]);
            }
        }
        return redirect()->back();
        // return 'ok';
        // $announcecategories = AnnounceCategory::get();
        // $pagestatuses = PageStatus::get();
        // return view('setting.admin.website.announce.create')->withAnnouncecategories($announcecategories)
        //                                                     ->withPagestatuses($pagestatuses);
    }
}
