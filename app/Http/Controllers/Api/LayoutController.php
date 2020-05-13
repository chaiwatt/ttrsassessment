<?php

namespace App\Http\Controllers\Api;

use App\Model\GeneralInfo;
use App\Model\WebsiteLayout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LayoutController extends Controller
{
    public function Edit(Request $request){
        GeneralInfo::first()->update([
            'layout_style_id' => $request->layout
        ]);
        foreach ($request->data as $item){
            WebsiteLayout::find($item['id'])->update([
                'order' => $item['order'],
                'status' => $item['value'],
            ]);
        }

        $websitelayouts = WebsiteLayout::get();
        return response()->json($websitelayouts);  
    }
}