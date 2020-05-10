<?php

namespace App\Http\Controllers\Api;

use App\Helper\CreateSlug;
use App\Model\PageCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageCategoryController extends Controller
{
    public function Add(Request $request){
        $pagecategory = new PageCategory();
        $pagecategory->name = $request->category;
        $pagecategory->slug = CreateSlug::createSlug($request->category);
        $pagecategory->save();

        return response()->json(PageCategory::get());  
    }
    public function Edit(Request $request){
        PageCategory::find($request->id)->update([
            'name' => $request->category,
            'slug' => CreateSlug::createSlug($request->category)
        ]);
        return response()->json(PageCategory::get());  
    }
    public function Delete(Request $request){
        PageCategory::find($request->id)->delete();
        return response()->json(PageCategory::get());  
    }
}
