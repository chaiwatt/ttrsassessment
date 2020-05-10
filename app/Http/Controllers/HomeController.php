<?php

namespace App\Http\Controllers;

use App\Model\IntroSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index()
    {
        $introsections = IntroSection::get();
        return view('landing.index')->withIntrosections($introsections);
    }

    public function Page()
    {
        return view('landing.page');
    }
}
