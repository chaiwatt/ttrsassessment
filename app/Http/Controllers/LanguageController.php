<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function Change($locale)
    { 
        Session::put('locale', $locale); 
        return redirect()->back(); 
    }
}
