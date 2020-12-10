<?php

namespace App\Http\Controllers;

use App\Model\Page;
use App\Model\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BlogCommentRequest;

class BlogController extends Controller
{
    public function Comment(BlogCommentRequest $request,$id){
        $page = Page::find($id);
        $blogcomment = new BlogComment();
        $blogcomment->page_id = $page->id;
        $blogcomment->user_id = Auth::user()->id;
        $blogcomment->comment = $request->comment;
        $blogcomment->save();
        return redirect()->back()->withSuccess('เพิ่มความเห็นสำเร็จ');
    }

    public function Delete($id){
        BlogComment::find($id)->delete();
        return redirect()->back()->withSuccess('ลบความเห็นสำเร็จ');
    }
}
