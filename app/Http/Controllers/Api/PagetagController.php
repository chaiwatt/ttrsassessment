<?php

namespace App\Http\Controllers\Api;

use App\Model\Tag;
use App\Helper\CreateSlug;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagetagController extends Controller
{
    public function Add(Request $request){
        $tag = new Tag();
        $tag->name = $request->tag;
        $tag->slug = CreateSlug::createSlug($request->tag);
        $tag->save();
        return response()->json(Tag::get());  
    }
    public function Edit(Request $request){
        Tag::find($request->id)->update([
            'name' => $request->tag,
            'slug' => CreateSlug::createSlug($request->tag)
        ]);
        return response()->json(Tag::get());  
    }
    public function Delete(Request $request){
        Tag::find($request->id)->delete();
        return response()->json(Tag::get());  
    }
}
