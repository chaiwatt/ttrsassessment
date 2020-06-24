<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FullTbpController extends Controller
{
    public function CompanyprofileAdd(Request $request){
        $tmp = '';
        foreach($request->lines as $line){
            $tmp .= ' '. $line;
        }
        dd($tmp);
    }
}
