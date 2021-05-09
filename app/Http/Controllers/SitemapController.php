<?php

namespace App\Http\Controllers;

use App\Model\Page;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function Index(){
        $pages= Page::get();
        return response()->view('sitemap.index', [
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }
}
