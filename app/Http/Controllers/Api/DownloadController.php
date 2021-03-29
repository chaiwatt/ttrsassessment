<?php

namespace App\Http\Controllers\Api;

use App\Model\DownloadStat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function Add(Request $request){
        $downloadstat = new DownloadStat();
        $downloadstat->document = $request->document;
        $downloadstat->user_id = Auth::user()->id;
        $downloadstat->save();
        return ; 
    }
}
