<?php

namespace App\Http\Controllers\Api;

use App\Model\PageCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function GetCategory(Request $request){
        $pagecategory = PageCategory::find($request->id);
        return response()->json($pagecategory);  
    }
}
