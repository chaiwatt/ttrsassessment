<?php

namespace App\Http\Controllers;

use App\Model\Tag;
use App\Model\Page;
use App\Model\PageStatus;
use App\Model\PageCategory;
use Illuminate\Http\Request;

class SettingAdminWebsitePageController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }

    public function Index(){
        $pages = Page::get();
        return view('setting.admin.website.page.index')->withPages($pages);
    }
    public function Create(){
        $pagecategories = PageCategory::get();
        $pagestatuses = PageStatus::get();
        $tags = Tag::get();
        return view('setting.admin.website.page.create')->withPagecategories($pagecategories)
                                                    ->withPagestatuses($pagestatuses)
                                                    ->withTags($tags);
    }
}
