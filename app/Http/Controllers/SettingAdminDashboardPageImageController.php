<?php

namespace App\Http\Controllers;

use App\Model\PageImage;
use Illuminate\Http\Request;

class SettingAdminDashboardPageImageController extends Controller
{
    public function Delete($id){
        PageImage::find($id)->delete();
        return redirect()->back()->withSuccess('ลบแกลอรี่สำเร็จ');
    }
}
