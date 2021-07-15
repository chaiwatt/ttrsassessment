<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Faq;
use App\Model\Tag;
use Carbon\Carbon;
use App\Model\Page;
use App\Model\Company;
use App\Model\PageTag;
use App\Model\Announce;
use App\Model\PageView;
use App\Model\PageImage;
use App\Model\DirectMenu;
use App\Model\GeneralInfo;
use App\Model\ExpertDetail;
use App\Model\FeatureImage;
use App\Model\IntroSection;
use App\Model\PageCategory;
use Jenssegers\Agent\Agent;
use App\Model\IndustryGroup;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;
use App\Model\CompanyAddress;
use App\Model\AnnounceCategory;
use App\Model\AnnounceAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function Index()
    {
        $generalinfo = GeneralInfo::first();
        $directmenu = DirectMenu::find(1);
        $directmenu->update([
            'view' => intVal($directmenu->view) +1
        ]);
        if(Session::get('front') == 'active'){
            return $this->Front();
        }else if($generalinfo->front_page_status_id == 2){
            Session::put('front', 'active');
            return view('front');
        }else{
            return $this->Front();
        }
    }
    
    public function Index2()
    {
        $generalinfo = GeneralInfo::first();
        if(Session::get('front') == 'active'){
            return $this->Front();
        }else if($generalinfo->front_page_status_id == 2){
            Session::put('front', 'active');
            return view('front');
        }else{
            return $this->Front();
        }
        return view('landing2.index');
    }

    public function Front()
    {
        return view('landing2.index');
    }

    public function News()
    {
        $pages = Page::orderBy('id','desc')->paginate(5);
        return view('landing2.news.index')->withPages($pages);
    }

    public function Page($slug)
    {
        $ip = \Request::getClientIp(true);
        $agent = new Agent();
        $page = Page::where('slug',$slug)->first();
        if(Empty($page)){
            return abort(404);
        }
        $user = "";
        if(Auth::check()){
            $user = Auth::user()->id;
        }
        $pageview = new PageView();
        $pageview->page_id = $page->id;
        $pageview->user_id = $user ;
        $pageview->device = $agent->device();
        $pageview->platform = $agent->platform();
        $pageview->browser = $agent->browser();
        $pageview->ipaddress = $ip;
        $pageview->save();

        $pages = Page::orderBy('id','desc')->paginate(5);
        $page = Page::where('slug',$slug)->first();
        if(Empty($page)){
            return abort(404);
        }
        return view('landing2.single')->withPage($page)->withPages($pages);
    }
    // public function Page($slug)
    // {
    //     $ip = \Request::getClientIp(true);
    //     $agent = new Agent();
    //     $page = Page::where('slug',$slug)->first();
    //     if(Empty($page)){
    //         return abort(404);
    //     }
    //     $user = "";
    //     if(Auth::check()){
    //         $user = Auth::user()->id;
    //     }
    //     $pageview = new PageView();
    //     $pageview->page_id = $page->id;
    //     $pageview->user_id = $user ;
    //     $pageview->device = $agent->device();
    //     $pageview->platform = $agent->platform();
    //     $pageview->browser = $agent->browser();
    //     $pageview->ipaddress = $ip;
    //     $pageview->save();
        
    //     $pagetags = PageTag::where('page_id',$page->id)->get();
    //     $pageimages = PageImage::where('page_id',$page->id)->get();
    //     $pages = Page::take(5)->get();
    //     return view('landing.single')->withPage($page)
    //                             ->withPagetags($pagetags)
    //                             ->withPageimages($pageimages)
    //                             ->withPages($pages);
    // }
    public function Tag($slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        $pagearray = PageTag::where('tag_id',$tag->id)->pluck('page_id')->toArray();
        $pages = Page::whereIn('id',$pagearray)->paginate(10);
        return view('landing.search')->withPages($pages);
    }
    public function Search(Request $request)
    {
        $pages = Page::where('name','LIKE','%' . $request->search . '%')->paginate(10);
    // return view('landing.search')->withPages($pages);
    return view('landing.single');
    }

    public function Blog()
    {
        $directmenu = DirectMenu::find(2);
        $directmenu->update([
            'view' => intVal($directmenu->view) +1
        ]);
 
        $pages = Page::where('page_status_id',1)->whereDate('publicdate', '<=', Carbon::now()->toDateTimeString())->paginate(10);
     
        return view('landing.blog')->withPages($pages);
    }

    public function Contact(){
        $directmenu = DirectMenu::find(5);
        $directmenu->update([
            'view' => intVal($directmenu->view) +1
        ]);
        $generalinfo = GeneralInfo::first();
        return view('landing.contact')->withGeneralinfo($generalinfo);
    }

    public function DemoTTRSUser(){
        DB::table('users')->insert([
            [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'สมพร',
                'lastname' => 'สกุลเจดี',
                'position' => NULL,
                'email' => 'ttrsjd2020@gmail.com',
                'email_verified_at' => '2021-05-25 00:00:00',
                'password' => '$2y$10$wXO5Oz2mqY/Qn.4QMru.Res5wRmMzCUm8yMPhuEc68V9BJ7lGQ4H.',
                'user_type_id' => '6',
                'phone' => NULL,
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'สมนึก',
                'lastname' => 'สกุลแอดมิน',
                'position' => NULL,
                'email' => 'ttrsmanager2020@gmail.com',
                'email_verified_at' => '2021-05-25 00:00:00',
                'password' => '$2y$10$wXO5Oz2mqY/Qn.4QMru.Res5wRmMzCUm8yMPhuEc68V9BJ7lGQ4H.',
                'user_type_id' => '5',
                'phone' => NULL,
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'อำไพพรรณ',
                'lastname' => 'ผ่องลำพูน',
                'position' => NULL,
                'email' => 'ttrsuser2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:11:12',
                'password' => '$2y$10$ZZJPTUR5awlkxruzuhJaM.GOY/G/YhRmL3GKV58uWVEACgmvpFKMu',
                'user_type_id' => '1',
                'phone' => '851547196',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => 'yaaxpkzvfBHr4r5HEvtwl4WjLPFKHbf6RF8tx8KFwbN6LN5LeFP06rjZhRDR',
                'created_at' => '2021-05-25 13:09:49',
                'updated_at' => '2021-05-28 10:04:35'
                ],
                [
                'prefix_id' =>'3',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '2352009432022',
                'name' => 'เจ้าหน้าที่เน่ย',
                'lastname' => 'เน้ย',
                'position' => NULL,
                'email' => 'ttrsexpertfive2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:19:53',
                'password' => '$2y$10$hA..vKLXuVecQiYfpC5LYO6lw73PaekvFF4cE1qaApuMPsckU74qS',
                'user_type_id' => '4',
                'phone' => '819559951',
                'address' => '99999999',
                'province_id' => '25',
                'amphur_id' => '355',
                'tambol_id' => '3209',
                'postal' => '36000',
                'address1' => '99999999',
                'province1_id' => '25',
                'amphur1_id' => '355',
                'tambol1_id' => '3209',
                'postal1' => '36000',
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:19:46',
                'updated_at' => '2021-06-18 09:55:10'
                ],
                [
                'prefix_id' =>'3',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '3024196717858',
                'name' => 'ป่าเขา',
                'lastname' => 'ลำเนาไพร',
                'position' => NULL,
                'email' => 'ttrsmemberone2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:21:19',
                'password' => '$2y$10$JxWJYRlSNNcgNfVS9d/.ZOX8BYmDmQd3wWgFeNdmivGXbWGK905f6',
                'user_type_id' => '3',
                'phone' => '635323995',
                'address' => '111',
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postal' => '11120',
                'address1' => '111',
                'province1_id' => '4',
                'amphur1_id' => '67',
                'tambol1_id' => '367',
                'postal1' => '11120',
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => '1oTCGNserovNaGXJgQODKem0zlMMapST5tdGOQ2TCk3kj4vsfuYDNvEzxeJI',
                'created_at' => '2021-05-25 13:21:10',
                'updated_at' => '2021-06-18 08:11:05'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '3904383603978',
                'name' => 'ฉันคือผู้เชี่ยวชาญ',
                'lastname' => 'กลับมายืนที่เดิม',
                'position' => NULL,
                'email' => 'ttrsexperttwo2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:23:08',
                'password' => '$2y$10$wXO5Oz2mqY/Qn.4QMru.Res5wRmMzCUm8yMPhuEc68V9BJ7lGQ4H.',
                'user_type_id' => '3',
                'phone' => '2111111111',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:23:01',
                'updated_at' => '2021-05-25 13:23:01'
                ],
                [
                'prefix_id' =>'3',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '6533402990363',
                'name' => 'ลำธาร',
                'lastname' => 'สายน้ำ',
                'position' => NULL,
                'email' => 'ttrsexpertfour2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:24:23',
                'password' => '$2y$10$eEwcfccy.hrdnYOw9hdzAeQdPbe75phkGnn6/tZl7kiaxxGJl7Jj.',
                'user_type_id' => '4',
                'phone' => '0635323995',
                'address' => '111',
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postal' => '11120',
                'address1' => '111',
                'province1_id' => '4',
                'amphur1_id' => '67',
                'tambol1_id' => '367',
                'postal1' => '11120',
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => 'VcR12Nwgznx5Otkwh26KMxCZ3L3AfeRCB84aUgVpnqc2QUZJ9W0mht5BZqcb',
                'created_at' => '2021-05-25 13:24:13',
                'updated_at' => '2021-06-18 14:17:24'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'ตัง',
                'lastname' => 'เม',
                'position' => NULL,
                'email' => 'ttrsusertwo2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:26:10',
                'password' => '$2y$10$z6V.cIEYhSIlkqjnQcxKZ.48DxNtsxeZhFhcxUedzA2VeX.fRcm8K',
                'user_type_id' => '1',
                'phone' => '942495240',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:25:56',
                'updated_at' => '2021-06-11 13:12:16'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '1473052267358',
                'name' => 'Leader CS',
                'lastname' => 'TTRS',
                'position' => NULL,
                'email' => 'ttrsleader2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:27:21',
                'password' => '$2y$10$wXO5Oz2mqY/Qn.4QMru.Res5wRmMzCUm8yMPhuEc68V9BJ7lGQ4H.',
                'user_type_id' => '4',
                'phone' => '877878787',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:27:15',
                'updated_at' => '2021-05-25 13:27:15'
                ],
                [
                'prefix_id' =>'4',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '4580278441759',
                'name' => 'มาดูกัน เปลี่ยนชื่อนะ',
                'lastname' => 'ว่ามินิจะได้มั๊ย',
                'position' => 'ผู้จัดการ',
                'email' => 'ttrscolead2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:29:09',
                'password' => '$2y$10$wXO5Oz2mqY/Qn.4QMru.Res5wRmMzCUm8yMPhuEc68V9BJ7lGQ4H.',
                'user_type_id' => '1',
                'phone' => '812345678',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:28:56',
                'updated_at' => '2021-06-11 15:33:51'
                ],
                [
                'prefix_id' =>'5',
                'alter_prefix' => 'มรว. คุณหญิง ศ.ดร.',
                'user_status_id' => '1',
                'hid' => '8364247498269',
                'name' => 'Expert PP',
                'lastname' => 'Three',
                'position' => NULL,
                'email' => 'ttrsexpertthree2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:31:12',
                'password' => '$2y$10$EqAtWFKx0D2GBs7r3VAk1O.VIRz7foGj9ql9223kjrR36nHl3RuEu',
                'user_type_id' => '3',
                'phone' => '811234555',
                'address' => '123456',
                'province_id' => '1',
                'amphur_id' => '1',
                'tambol_id' => '1',
                'postal' => '12345',
                'address1' => '123456',
                'province1_id' => '1',
                'amphur1_id' => '1',
                'tambol1_id' => '1',
                'postal1' => '12345',
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:31:04',
                'updated_at' => '2021-06-11 10:00:04'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '7205095547347',
                'name' => 'เก่งกาจ',
                'lastname' => 'เกษตรกรรม',
                'position' => NULL,
                'email' => 'khemratha@gmail.com',
                'email_verified_at' => '2021-05-25 13:32:30',
                'password' => '$2y$10$X9R7PomX0nSoBFwOryqfmuy/mwyo2Mwqcq1zr5UDJy6KAZS5M.rLm',
                'user_type_id' => '4',
                'phone' => '851547196',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => 'XeA1DtDBsLk973LfXjEeT0ENApUr2OmHnr86iuUslEzi8FHjnr9MlTigoq7Y',
                'created_at' => '2021-05-25 13:32:24',
                'updated_at' => '2021-05-28 14:12:50'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '',
                'name' => 'จินดา',
                'lastname' => 'มณีสุข',
                'position' => NULL,
                'email' => 'ttrsuser1@gmail.com',
                'email_verified_at' => '2021-05-25 13:33:56',
                'password' => '$2y$10$OIRe/cvzsM3BOQawBGYYdu0oOyjpGct0WX/ZbELPY0EafgT14/xW6',
                'user_type_id' => '1',
                'phone' => '530932544',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:33:47',
                'updated_at' => '2021-05-25 13:33:47'
                ],
                [
                'prefix_id' =>'5',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'พชรกร',
                'lastname' => 'เกียรติขจรก้องไพศาล',
                'position' => NULL,
                'email' => 'pimpisa@nstda.or.th',
                'email_verified_at' => '2021-05-25 13:37:41',
                'password' => '$2y$10$dxPHYZy3Ig7OMtYJ9aR76.6jcTZNKWV5wRuffWwMvbiOs0gz475J6',
                'user_type_id' => '1',
                'phone' => '811234567',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:37:33',
                'updated_at' => '2021-06-18 10:46:12'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '',
                'name' => 'ผู้ประกอบการPN',
                'lastname' => 'คนงาม',
                'position' => NULL,
                'email' => 'ttrsexpertone2020@gmail.com',
                'email_verified_at' => '2021-05-25 13:38:49',
                'password' => '$2y$10$OSO88I9Cq3ardAyX3h53Tuq7UuAH3iBr1smc2ft.nEDZJs37I1HHG',
                'user_type_id' => '1',
                'phone' => '819559952',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:38:43',
                'updated_at' => '2021-05-25 13:38:43'
                ],
                [
                'prefix_id' =>'3',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'ผู้ประกอบการPN',
                'lastname' => 'คนเดิม',
                'position' => NULL,
                'email' => 'nunu12nana12@gmail.com',
                'email_verified_at' => '2021-05-25 13:40:05',
                'password' => '$2y$10$MLdKFSuri0NeBEd2PeZviuArNYBOyS9Dr.5Ramgb5bPVF5FemsyoS',
                'user_type_id' => '1',
                'phone' => '811111111',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:39:59',
                'updated_at' => '2021-05-27 10:48:42'
                ],
                [
                'prefix_id' =>'3',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'ทีวี',
                'lastname' => 'ทีวีจี',
                'position' => NULL,
                'email' => 'tvcompany35@gmail.com',
                'email_verified_at' => '2021-05-25 13:41:09',
                'password' => '$2y$10$2W.8A6sMyc2G0YybVWRQ4ecKmTebuSwp1hbLl1YKa3BtQktD9xkX.',
                'user_type_id' => '1',
                'phone' => '635323995',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:41:04',
                'updated_at' => '2021-06-11 07:57:05'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '5019338724281',
                'name' => 'ใครไม่แอล',
                'lastname' => 'แอลแอล กอฮอลิค',
                'position' => NULL,
                'email' => 'pantaree.phu@nstda.or.th',
                'email_verified_at' => '2021-05-25 13:42:13',
                'password' => '$2y$10$aPCjLMNmH4mSlcvYaOxGKO8vv0zv4feHD7GbA3OK.ux8G9Bl6wcEi',
                'user_type_id' => '1',
                'phone' => '894133661',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:42:09',
                'updated_at' => '2021-05-25 13:42:09'
                ],
                [
                'prefix_id' =>'5',
                'alter_prefix' => 'ดร.',
                'user_status_id' => '1',
                'hid' => '7723209799505',
                'name' => 'ซอจอง',
                'lastname' => 'จิ้มลิ้ม',
                'position' => 'CTO',
                'email' => 'chamaiporn.sud@nstda.or.th',
                'email_verified_at' => '2021-05-25 13:43:17',
                'password' => '$2y$10$8GX0F2/rMABXzI/Wot1G5eHxXsButx9bXqeBT/9fQVr3B5r/ZykES',
                'user_type_id' => '1',
                'phone' => '055555555',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:43:12',
                'updated_at' => '2021-06-11 10:30:43'
                ],
                [
                'prefix_id' =>'6',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '9558745791189',
                'name' => 'เจ้าหน้าที่',
                'lastname' => 'KC',
                'position' => NULL,
                'email' => 'kanticha.cha@nstda.or.th',
                'email_verified_at' => '2021-05-25 13:44:29',
                'password' => '$2y$10$UsS2rte7HmdjZWckSAS5munkFLJn3AvKZn7A2XM/YUM.Lvsew0qD2',
                'user_type_id' => '4',
                'phone' => '88888888',
                'address' => 'นนทบุเรี่ยน',
                'province_id' => '3',
                'amphur_id' => '61',
                'tambol_id' => '333',
                'postal' => '11110',
                'address1' => 'นนทบุเรี่ยน',
                'province1_id' => '3',
                'amphur1_id' => '61',
                'tambol1_id' => '333',
                'postal1' => '11110',
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => '13.879937',
                'lng' => '100.413414',
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:44:24',
                'updated_at' => '2021-06-18 13:18:09'
                ],
                [
                'prefix_id' =>'5',
                'alter_prefix' => 'มรว.ดร.คุณหญิง',
                'user_status_id' => '1',
                'hid' => '1234567891234',
                'name' => 'เจ้าหน้าที่ PP',
                'lastname' => 'TTRS',
                'position' => NULL,
                'email' => 'staffttrs0986@gmail.com',
                'email_verified_at' => '2021-05-25 13:45:50',
                'password' => '$2y$10$NXm7GJOTyJEO8dbYe/UEH.rmKZno8ACwuQIe1eOqZ/DcrDwH2hnHu',
                'user_type_id' => '4',
                'phone' => '811234567',
                'address' => '123',
                'province_id' => '1',
                'amphur_id' => '7',
                'tambol_id' => '53',
                'postal' => '66666',
                'address1' => '123',
                'province1_id' => '1',
                'amphur1_id' => '7',
                'tambol1_id' => '53',
                'postal1' => '66666',
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => '13.74595174299881,',
                'lng' => '100.53943367207118',
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:45:45',
                'updated_at' => '2021-05-28 15:52:12'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '8948045116371',
                'name' => 'ฉันเป็นเจ้าของ',
                'lastname' => 'โครงการนะจ๊ะ',
                'position' => 'CEO',
                'email' => 'ttrstrial2021@gmail.com',
                'email_verified_at' => '2021-05-25 13:47:11',
                'password' => '$2y$10$ydGm38iyk7A1ona57ASqGeLpkXUsNOWxEREjtjbKesFXYUyaD83TW',
                'user_type_id' => '1',
                'phone' => '254444444',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:47:03',
                'updated_at' => '2021-06-11 11:39:16'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '3831605889617',
                'name' => 'ลีดดดดดดด',
                'lastname' => 'เดอร์',
                'position' => NULL,
                'email' => 'noramon.int@nstda.or.th',
                'email_verified_at' => '2021-05-25 13:48:09',
                'password' => '$2y$10$k6fWluwX8vCGrk3BCwpRWuNgDa4T.BmFbk2bw0QgMhlRjZ08gk/Gu',
                'user_type_id' => '4',
                'phone' => '053642546',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-05-25 13:48:04',
                'updated_at' => '2021-05-25 13:48:04'
                ],
                [
                'prefix_id' =>'2',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '8543430945462',
                'name' => 'เคเค',
                'lastname' => 'เปลี่ยนมั่วได้ไง',
                'position' => NULL,
                'email' => 'khemratha@nstda.or.th',
                'email_verified_at' => '2021-06-11 00:00:00',
                'password' => '$2y$10$zE0b50pojX2nC8tEeD0hb.UafMZTorQgxkb3IpAoWOS0yyea7ZsxO',
                'user_type_id' => '4',
                'phone' => '0851547196',
                'address' => '111',
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postal' => '12120',
                'address1' => '111',
                'province1_id' => '4',
                'amphur1_id' => '67',
                'tambol1_id' => '367',
                'postal1' => '12120',
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => 'Ya9xKfmU79RvdJMojiA7ZLHyShMyLjdWVa9uW39Jb1cO1DuBr2w0p3xtw9r6',
                'created_at' => '2021-05-28 10:28:23',
                'updated_at' => '2021-06-16 10:40:57'
                ],
                [
                'prefix_id' =>'1',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => '9848838655100',
                'name' => 'ใครไม่เชี่ยวชาญ',
                'lastname' => 'ผู้เชี่ยวชาญแอลแอล',
                'position' => NULL,
                'email' => 'sumlong.tn@gmail.com',
                'email_verified_at' => '2021-06-11 00:00:00',
                'password' => '$2y$10$j4oKIHe67LQ/6YwdbKoybulQacIa6fKdOUN1m/hF3YwLQLPYoi51q',
                'user_type_id' => '4',
                'phone' => '0894133662',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '2',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => 'j5EE7WWYKD25JapxHnAJnhY5oOgAN2KXk5BOH3N0NT0dq8uevYZHSM4zZdVA',
                'created_at' => '2021-06-11 09:04:59',
                'updated_at' => '2021-06-11 09:08:11'
                ],
                [
                'prefix_id' =>'3',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'วิลาวัลย์',
                'lastname' => 'กลอบอไรเซชั่น',
                'position' => NULL,
                'email' => 'm_u_ka23@yahoo.com',
                'email_verified_at' => '2021-06-11 00:00:00',
                'password' => '$2y$10$1ZfJI5tO7KWvdO.KVBkilOhuSr4hmghcg5lkO8URRABZwc0u8LvnW',
                'user_type_id' => '1',
                'phone' => '0851547196',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => 'RVey6fgybz1ibVYt3QZyq6yVWnbRNZSRag9p8lHVTjubZ9fcA3rZlU4mSwAk',
                'created_at' => '2021-06-11 10:51:04',
                'updated_at' => '2021-06-11 14:10:24'
                ],
                [
                'prefix_id' =>'4',
                'alter_prefix' => NULL,
                'user_status_id' => '1',
                'hid' => NULL,
                'name' => 'ตังเม',
                'lastname' => 'ไงล่าา',
                'position' => NULL,
                'email' => 'tungmay140@hotmail.com',
                'email_verified_at' => '2021-06-11 00:00:00',
                'password' => '$2y$10$FJljAxkMEF5npSp2l2/2h.mZoPJtSXPh9k2ROv1528kLQl1IBI7ju',
                'user_type_id' => '1',
                'phone' => '0942495240',
                'address' => NULL,
                'province_id' => NULL,
                'amphur_id' => NULL,
                'tambol_id' => NULL,
                'postal' => NULL,
                'address1' => NULL,
                'province1_id' => NULL,
                'amphur1_id' => NULL,
                'tambol1_id' => NULL,
                'postal1' => NULL,
                'verify_type' => '1',
                'allow_assessment' => '1',
                'user_group_id' => '1',
                'lat' => NULL,
                'lng' => NULL,
                'isexpert' => '1',
                'verify_expert' => '1',
                'remember_token' => NULL,
                'created_at' => '2021-06-11 13:13:21',
                'updated_at' => '2021-06-11 13:20:43'
                ]
        ]);

        DB::table('companies')->insert([
            [
            'user_id' =>'1',
            'vatno' => '0994000165668',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '2',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => 'สวทช',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-05-25 13:07:38',
            'updated_at' => '2021-05-25 13:07:38'
            ],
            [
            'user_id' =>'2',
            'vatno' => '0994000165667',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '2',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => 'สวทช',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-05-25 13:07:38',
            'updated_at' => '2021-05-25 13:07:38'
            ],
            [
            'user_id' =>'3',
            'vatno' => '9750815350896',
            'commercialregnumber' => NULL,
            'isic_id' => '18',
            'isic_sub_id' => '79',
            'registeredyear' => '2550',
            'registeredcapital' => '5000000',
            'registeredcapitaltype' => '1',
            'paidupcapital' => '5000000',
            'paidupcapitaldate' => '05/12/20',
            'industry_group_id' => '3',
            'business_type_id' => '2',
            'company_service_type_id' => '1',
            'company_size_id' => '1',
            'name' => 'เกรียงไกรทัวร์',
            'phone' => '851547196',
            'email' => 'ttrsuser2020@gmail.com',
            'organizeimg' => 'storage/uploads/company/attachment/pvcF1ywxsA.png',
            'companyhistory' => '<p>aaaaaaaaaaaaaaaaaaaaaaaaaaa</p>',
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:09:49',
            'updated_at' => '2021-05-25 14:39:02'
            ],
            [
            'user_id' =>'4',
            'vatno' => '2352009432022',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:19:46',
            'updated_at' => '2021-06-11 09:03:57'
            ],
            [
            'user_id' =>'5',
            'vatno' => '3024196717858',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:21:10',
            'updated_at' => '2021-06-18 08:11:05'
            ],
            [
            'user_id' =>'6',
            'vatno' => '3904383603978',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-05-25 13:23:01',
            'updated_at' => '2021-05-25 13:23:01'
            ],
            [
            'user_id' =>'7',
            'vatno' => '6533402990363',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:24:13',
            'updated_at' => '2021-06-18 14:17:24'
            ],
            [
            'user_id' =>'8',
            'vatno' => '2513813143742',
            'commercialregnumber' => NULL,
            'isic_id' => '3',
            'isic_sub_id' => '9',
            'registeredyear' => '2555',
            'registeredcapital' => '6000000',
            'registeredcapitaltype' => '1',
            'paidupcapital' => '6000000',
            'paidupcapitaldate' => '12/25/07',
            'industry_group_id' => '5',
            'business_type_id' => '3',
            'company_service_type_id' => '1',
            'company_size_id' => '2',
            'name' => 'กรีนทีคอฟฟี่',
            'phone' => '942495240',
            'email' => 'ttrsusertwo2020@gmail.com',
            'organizeimg' => 'storage/uploads/company/attachment/xAQqfngRob.png',
            'companyhistory' => '<p>dddddddddddddddddddddd</p>',
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:25:56',
            'updated_at' => '2021-05-25 15:20:44'
            ],
            [
            'user_id' =>'9',
            'vatno' => '1473052267358',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-05-25 13:27:15',
            'updated_at' => '2021-05-25 13:27:15'
            ],
            [
            'user_id' =>'10',
            'vatno' => '4580278441759',
            'commercialregnumber' => '25624223',
            'isic_id' => '19',
            'isic_sub_id' => '85',
            'registeredyear' => '2551',
            'registeredcapital' => '5000000',
            'registeredcapitaltype' => '1',
            'paidupcapital' => '5000000',
            'paidupcapitaldate' => '06/21/07',
            'industry_group_id' => '13',
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '1',
            'name' => 'บ้านรักแมว',
            'phone' => '0812345678',
            'email' => 'ttrscolead2020@gmail.com',
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:28:56',
            'updated_at' => '2021-06-18 13:29:37'
            ],
            [
            'user_id' =>'11',
            'vatno' => '8364247498269',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:31:04',
            'updated_at' => '2021-06-11 10:00:04'
            ],
            [
            'user_id' =>'12',
            'vatno' => '7205095547347',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-05-25 13:32:24',
            'updated_at' => '2021-05-25 13:32:24'
            ],
            [
            'user_id' =>'13',
            'vatno' => '1394623834048',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '2',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-05-25 13:33:47',
            'updated_at' => '2021-05-25 13:33:47'
            ],
            [
            'user_id' =>'14',
            'vatno' => '7620587386519',
            'commercialregnumber' => NULL,
            'isic_id' => '3',
            'isic_sub_id' => '9',
            'registeredyear' => '2545',
            'registeredcapital' => '100',
            'registeredcapitaltype' => '1',
            'paidupcapital' => '1',
            'paidupcapitaldate' => '01/01/02',
            'industry_group_id' => '5',
            'business_type_id' => '1',
            'company_service_type_id' => '1',
            'company_size_id' => '3',
            'name' => '2P Food and Bev',
            'phone' => '0811234567',
            'email' => 'pimpisa@nstda.or.th',
            'organizeimg' => 'storage/uploads/company/attachment/HL2hJNH0au.jpg',
            'companyhistory' => '<p>ประวัติบริษัทยาวนานมากบรรยายไม่หมดภายในหนึ่งหน้ากระดาษ A4</p>',
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:37:33',
            'updated_at' => '2021-06-18 13:25:48'
            ],
            [
            'user_id' =>'15',
            'vatno' => '1284536706883',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '2',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-05-25 13:38:43',
            'updated_at' => '2021-05-25 13:38:43'
            ],
            [
            'user_id' =>'16',
            'vatno' => '1428747545181',
            'commercialregnumber' => NULL,
            'isic_id' => '12',
            'isic_sub_id' => '60',
            'registeredyear' => '7777',
            'registeredcapital' => '2',
            'registeredcapitaltype' => '1',
            'paidupcapital' => '1',
            'paidupcapitaldate' => '09/21/20',
            'industry_group_id' => '13',
            'business_type_id' => '1',
            'company_service_type_id' => '2',
            'company_size_id' => '4',
            'name' => 'บริษัท พีเอ็นPN จำกัด',
            'phone' => '811111111',
            'email' => 'nunu12nana12@gmail.com',
            'organizeimg' => 'storage/uploads/company/attachment/jPgYkAKCOY.png',
            'companyhistory' => '<p>สวยงามตามท้องเรื่อง</p>',
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:39:59',
            'updated_at' => '2021-06-11 10:41:05'
            ],
            [
            'user_id' =>'17',
            'vatno' => '3362365999117',
            'commercialregnumber' => NULL,
            'isic_id' => '9',
            'isic_sub_id' => '49',
            'registeredyear' => '2560',
            'registeredcapital' => '10000000',
            'registeredcapitaltype' => '1',
            'paidupcapital' => '10000000',
            'paidupcapitaldate' => '05/03/17',
            'industry_group_id' => '3',
            'business_type_id' => '2',
            'company_service_type_id' => '2',
            'company_size_id' => '2',
            'name' => 'ทีวี',
            'phone' => '0635323995',
            'email' => 'tvcompany35@gmail.com',
            'organizeimg' => 'storage/uploads/company/attachment/FyUWp7qQ0x.jpg',
            'companyhistory' => '<p><i style="color: rgb(51, 51, 51);">การก่อตั้ง 3 5 2560</i></p><p><i style="color: rgb(51, 51, 51);">การเพิ่มทุน ปี 2564 จำนวน 9,000,000 บาท</i></p><p><i style="color: rgb(51, 51, 51);">การเปลี่ยนแปลงทางธุรกิจ เดิมประกอบกิจการร้านกาแฟ และพัฒนามาเป็นที่พักและกำลังพัฒนาให้อยู่ในรูปของ Wellness</i><i style="color: rgb(51, 51, 51);"><br></i><i style="color: rgb(51, 51, 51);"><br></i><br></p>',
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:41:04',
            'updated_at' => '2021-06-11 10:35:31'
            ],
            [
            'user_id' =>'18',
            'vatno' => '5019338724281',
            'commercialregnumber' => NULL,
            'isic_id' => '13',
            'isic_sub_id' => '64',
            'registeredyear' => NULL,
            'registeredcapital' => '0',
            'registeredcapitaltype' => '4',
            'paidupcapital' => '0',
            'paidupcapitaldate' => NULL,
            'industry_group_id' => '9',
            'business_type_id' => '5',
            'company_service_type_id' => '2',
            'company_size_id' => '1',
            'name' => 'บริษัท ไอทีบายแอล แอล จำกัด',
            'phone' => '894133661',
            'email' => 'rtyuiop[]@nstda.or.th',
            'organizeimg' => 'storage/uploads/company/attachment/sGQ12MCils.jpg',
            'companyhistory' => 'บริษัทเราก่อตั้งขึ้นเมื่อชาติที่แล้วค่ะ ส่งต่อมายังรุ่นสู่รุ่น เพราะถนัดสืบทอดอำนาจมากกว่า ตอนนี้ก็รักษาการณ์ CEO มา 7 ปีแล้ว ขึ้นปีที่ 8 แล้ว ผมมองไปข้างนอกก็อยากให้ประชาชนของผมอยู่ดีกินดีโดยไม่ต้องการอะไรจากพวกเขาเลย',
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:42:09',
            'updated_at' => '2021-06-11 11:24:12'
            ],
            [
            'user_id' =>'19',
            'vatno' => '7723209799505',
            'commercialregnumber' => NULL,
            'isic_id' => '16',
            'isic_sub_id' => '75',
            'registeredyear' => NULL,
            'registeredcapital' => '0',
            'registeredcapitaltype' => '4',
            'paidupcapital' => '0',
            'paidupcapitaldate' => NULL,
            'industry_group_id' => '12',
            'business_type_id' => '5',
            'company_service_type_id' => '2',
            'company_size_id' => '1',
            'name' => 'C S Innovation',
            'phone' => '00000000',
            'email' => 'chamaiporn.sud@nstda.or.th',
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:43:12',
            'updated_at' => '2021-06-11 10:30:43'
            ],
            [
            'user_id' =>'20',
            'vatno' => '9558745791189',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:44:24',
            'updated_at' => '2021-05-27 13:18:45'
            ],
            [
            'user_id' =>'21',
            'vatno' => '8639226651256',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '2',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:45:45',
            'updated_at' => '2021-05-28 15:48:32'
            ],
            [
            'user_id' =>'22',
            'vatno' => '8948045116371',
            'commercialregnumber' => NULL,
            'isic_id' => '1',
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => '0',
            'registeredcapitaltype' => '4',
            'paidupcapital' => '0',
            'paidupcapitaldate' => NULL,
            'industry_group_id' => '13',
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '1',
            'name' => 'ชอบดม นิ NI',
            'phone' => '254444444',
            'email' => 'ttrstrial2021@gmail.com',
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-25 13:47:03',
            'updated_at' => '2021-06-11 11:39:16'
            ],
            [
            'user_id' =>'23',
            'vatno' => '3831605889617',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-05-25 13:48:04',
            'updated_at' => '2021-05-25 13:48:04'
            ],
            [
            'user_id' =>'24',
            'vatno' => '8543430945462',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-05-28 10:28:23',
            'updated_at' => '2021-05-28 10:33:55'
            ],
            [
            'user_id' =>'25',
            'vatno' => '9848838655100',
            'commercialregnumber' => NULL,
            'isic_id' => NULL,
            'isic_sub_id' => NULL,
            'registeredyear' => NULL,
            'registeredcapital' => NULL,
            'registeredcapitaltype' => NULL,
            'paidupcapital' => NULL,
            'paidupcapitaldate' => NULL,
            'industry_group_id' => NULL,
            'business_type_id' => '5',
            'company_service_type_id' => '1',
            'company_size_id' => '0',
            'name' => '',
            'phone' => NULL,
            'email' => NULL,
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '0',
            'created_at' => '2021-06-11 09:04:59',
            'updated_at' => '2021-06-11 09:04:59'
            ],
            [
            'user_id' =>'26',
            'vatno' => '2461647059138',
            'commercialregnumber' => NULL,
            'isic_id' => '1',
            'isic_sub_id' => '1',
            'registeredyear' => '2556',
            'registeredcapital' => '5000000',
            'registeredcapitaltype' => '1',
            'paidupcapital' => '2000000',
            'paidupcapitaldate' => '04/30/15',
            'industry_group_id' => '4',
            'business_type_id' => '2',
            'company_service_type_id' => '1',
            'company_size_id' => '1',
            'name' => 'Global Seed Growing',
            'phone' => '0851547196',
            'email' => 'm_u_ka23@yahoo.com',
            'organizeimg' => NULL,
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-06-11 10:51:04',
            'updated_at' => '2021-06-11 14:10:24'
            ],
            [
            'user_id' =>'27',
            'vatno' => '6073942302437',
            'commercialregnumber' => NULL,
            'isic_id' => '8',
            'isic_sub_id' => '47',
            'registeredyear' => '2576',
            'registeredcapital' => '5000000',
            'registeredcapitaltype' => '1',
            'paidupcapital' => '900000000',
            'paidupcapitaldate' => '12/01/47',
            'industry_group_id' => '7',
            'business_type_id' => '2',
            'company_service_type_id' => '1',
            'company_size_id' => '4',
            'name' => 'มัทฉะเวอร์ชันอัพเดทจริงเชื่อถือได้',
            'phone' => '0942495240',
            'email' => 'tungmay140@hotmail.com',
            'organizeimg' => 'storage/uploads/company/attachment/gkj9DMlMy2.jpg',
            'companyhistory' => NULL,
            'saveprofile' => '1',
            'created_at' => '2021-06-11 13:13:21',
            'updated_at' => '2021-06-18 10:42:22'
            ]
        ]);

        DB::table('company_addresses')->insert([
            [
                'company_id' =>'1',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:07:38',
                'updated_at' => '2021-05-25 13:07:38'
                ],
                [
                'company_id' =>'2',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:07:38',
                'updated_at' => '2021-05-25 13:07:38'
                ],
                [
                'company_id' =>'3',
                'address' => '225',
                'province_id' => '38',
                'amphur_id' => '582',
                'tambol_id' => '5287',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:09:49',
                'updated_at' => '2021-05-25 14:24:15'
                ],
                [
                'company_id' =>'4',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:19:46',
                'updated_at' => '2021-05-25 13:19:46'
                ],
                [
                'company_id' =>'5',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:21:10',
                'updated_at' => '2021-05-25 13:21:10'
                ],
                [
                'company_id' =>'6',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:23:01',
                'updated_at' => '2021-05-25 13:23:01'
                ],
                [
                'company_id' =>'7',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:24:13',
                'updated_at' => '2021-05-25 13:24:13'
                ],
                [
                'company_id' =>'8',
                'address' => '222',
                'province_id' => '17',
                'amphur_id' => '202',
                'tambol_id' => '1649',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:25:56',
                'updated_at' => '2021-05-25 15:16:07'
                ],
                [
                'company_id' =>'9',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:27:15',
                'updated_at' => '2021-05-25 13:27:15'
                ],
                [
                'company_id' =>'10',
                'address' => '111',
                'province_id' => '29',
                'amphur_id' => '421',
                'tambol_id' => '3732',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:28:56',
                'updated_at' => '2021-05-25 15:26:21'
                ],
                [
                'company_id' =>'11',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:31:04',
                'updated_at' => '2021-05-25 13:31:04'
                ],
                [
                'company_id' =>'12',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:32:24',
                'updated_at' => '2021-05-25 13:32:24'
                ],
                [
                'company_id' =>'13',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:33:47',
                'updated_at' => '2021-05-25 13:33:47'
                ],
                [
                'company_id' =>'14',
                'address' => '123-456',
                'province_id' => '1',
                'amphur_id' => '1',
                'tambol_id' => '1',
                'postalcode' => '12345',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:37:33',
                'updated_at' => '2021-06-18 10:46:12'
                ],
                [
                'company_id' =>'15',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:38:43',
                'updated_at' => '2021-05-25 13:38:43'
                ],
                [
                'company_id' =>'16',
                'address' => 'บริษัท พีเอ็นPN จำกัด',
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => '14.08591871269081',
                'lng' => '100.60534871075816',
                'created_at' => '2021-05-25 13:39:59',
                'updated_at' => '2021-05-27 10:48:42'
                ],
                [
                'company_id' =>'17',
                'address' => '89',
                'province_id' => '57',
                'amphur_id' => '799',
                'tambol_id' => '7155',
                'postalcode' => '72180',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:41:04',
                'updated_at' => '2021-06-11 07:57:05'
                ],
                [
                'company_id' =>'18',
                'address' => '11',
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:42:09',
                'updated_at' => '2021-05-27 14:22:26'
                ],
                [
                'company_id' =>'19',
                'address' => 'สลน',
                'province_id' => '3',
                'amphur_id' => '59',
                'tambol_id' => '311',
                'postalcode' => '12720',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:43:12',
                'updated_at' => '2021-06-11 10:30:43'
                ],
                [
                'company_id' =>'20',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:44:24',
                'updated_at' => '2021-05-25 13:44:24'
                ],
                [
                'company_id' =>'21',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:45:45',
                'updated_at' => '2021-05-25 13:45:45'
                ],
                [
                'company_id' =>'22',
                'address' => 'จังวา',
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:47:03',
                'updated_at' => '2021-06-11 11:39:16'
                ],
                [
                'company_id' =>'23',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-25 13:48:04',
                'updated_at' => '2021-05-25 13:48:04'
                ],
                [
                'company_id' =>'24',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-05-28 10:28:23',
                'updated_at' => '2021-05-28 10:28:23'
                ],
                [
                'company_id' =>'25',
                'address' => NULL,
                'province_id' => '4',
                'amphur_id' => '67',
                'tambol_id' => '367',
                'postalcode' => '12120',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-06-11 09:04:59',
                'updated_at' => '2021-06-11 09:04:59'
                ],
                [
                'company_id' =>'26',
                'address' => '5555',
                'province_id' => '45',
                'amphur_id' => '659',
                'tambol_id' => '5919',
                'postalcode' => '57140',
                'lat' => NULL,
                'lng' => NULL,
                'created_at' => '2021-06-11 10:51:04',
                'updated_at' => '2021-06-11 14:10:24'
                ],
                [
                'company_id' =>'27',
                'address' => 'นนทบุเรี่ยน',
                'province_id' => '3',
                'amphur_id' => '61',
                'tambol_id' => '333',
                'postalcode' => '12120',
                'lat' => '1423546547567687797808909009',
                'lng' => '1232425456565766867988890554645756877978089090090',
                'created_at' => '2021-06-11 13:13:21',
                'updated_at' => '2021-06-11 13:20:43'
                ] 
        ]);

        DB::table('officer_details')->insert([
            [
                'user_id' =>'1',
                'position' => NULL,
                'organization' => NULL,
                'education_level_id' => '1',
                'officer_branch_id' => '1',
                'expereinceyear' => NULL,
                'expereincemonth' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
                ],
                [
                'user_id' =>'2',
                'position' => NULL,
                'organization' => NULL,
                'education_level_id' => '1',
                'officer_branch_id' => '1',
                'expereinceyear' => NULL,
                'expereincemonth' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL
                ],
                [
                'user_id' =>'4',
                'position' => 'ที่ปรึกษา',
                'organization' => 'สวทช.',
                'education_level_id' => '1',
                'officer_branch_id' => '8',
                'expereinceyear' => '99',
                'expereincemonth' => '11',
                'created_at' => '2021-05-25 13:19:46',
                'updated_at' => '2021-06-11 09:03:57'
                ],
                [
                'user_id' =>'9',
                'position' => NULL,
                'organization' => NULL,
                'education_level_id' => '1',
                'officer_branch_id' => '1',
                'expereinceyear' => NULL,
                'expereincemonth' => NULL,
                'created_at' => '2021-05-25 13:27:15',
                'updated_at' => '2021-05-25 13:27:15'
                ],
                [
                'user_id' =>'12',
                'position' => NULL,
                'organization' => NULL,
                'education_level_id' => '1',
                'officer_branch_id' => '1',
                'expereinceyear' => NULL,
                'expereincemonth' => NULL,
                'created_at' => '2021-05-25 13:32:24',
                'updated_at' => '2021-05-25 13:32:24'
                ],
                [
                'user_id' =>'20',
                'position' => 'นักวิเคราะห์สึสึสึ',
                'organization' => 'สวทช.',
                'education_level_id' => '4',
                'officer_branch_id' => '15',
                'expereinceyear' => '0',
                'expereincemonth' => '4',
                'created_at' => '2021-05-25 13:44:24',
                'updated_at' => '2021-06-18 10:15:17'
                ],
                [
                'user_id' =>'23',
                'position' => NULL,
                'organization' => NULL,
                'education_level_id' => '1',
                'officer_branch_id' => '1',
                'expereinceyear' => NULL,
                'expereincemonth' => NULL,
                'created_at' => '2021-05-25 13:48:04',
                'updated_at' => '2021-05-25 13:48:04'
                ],
                [
                'user_id' =>'21',
                'position' => 'เจ้าหน้าที่ TTRS',
                'organization' => 'NSTDA',
                'education_level_id' => '4',
                'officer_branch_id' => '5',
                'expereinceyear' => '35',
                'expereincemonth' => '11',
                'created_at' => '2021-05-27 14:03:13',
                'updated_at' => '2021-05-28 15:52:12'
                ],
                [
                'user_id' =>'24',
                'position' => 'จนท.พัฒนาธุรกิจ',
                'organization' => 'ศจ',
                'education_level_id' => '1',
                'officer_branch_id' => '17',
                'expereinceyear' => '99',
                'expereincemonth' => '11',
                'created_at' => '2021-05-28 10:28:23',
                'updated_at' => '2021-06-16 10:40:57'
                ],
                [
                'user_id' =>'25',
                'position' => NULL,
                'organization' => NULL,
                'education_level_id' => '1',
                'officer_branch_id' => '1',
                'expereinceyear' => NULL,
                'expereincemonth' => NULL,
                'created_at' => '2021-06-11 09:04:59',
                'updated_at' => '2021-06-11 09:04:59'
                ],
                [
                'user_id' =>'7',
                'position' => 'นักวิเคราะห์',
                'organization' => 'สวทช.',
                'education_level_id' => '1',
                'officer_branch_id' => '1',
                'expereinceyear' => '18',
                'expereincemonth' => '2',
                'created_at' => '2021-06-11 09:39:24',
                'updated_at' => '2021-06-18 14:17:24'
                ],
        ]);

        DB::table('expert_details')->insert([
            [
                'user_id' =>'6',
                'position' => NULL,
                'organization' => NULL,
                'education_level_id' => '1',
                'expert_branch_id' => '1',
                'expert_type_id' => '2',
                'expereinceyear' => NULL,
                'expereincemonth' => NULL,
                'created_at' => '2021-05-25 13:23:01',
                'updated_at' => '2021-05-25 13:23:01'
                ],
                [
                'user_id' =>'11',
                'position' => 'Professor',
                'organization' => 'expert co.',
                'education_level_id' => '3',
                'expert_branch_id' => '7',
                'expert_type_id' => '1',
                'expereinceyear' => '59',
                'expereincemonth' => '11',
                'created_at' => '2021-05-25 13:31:04',
                'updated_at' => '2021-06-11 10:00:04'
                ],
                [
                'user_id' =>'5',
                'position' => 'นักวิเคราะห์',
                'organization' => 'สวทช.',
                'education_level_id' => '2',
                'expert_branch_id' => '18',
                'expert_type_id' => '1',
                'expereinceyear' => '18',
                'expereincemonth' => '2',
                'created_at' => '2021-06-15 13:59:38',
                'updated_at' => '2021-06-18 08:11:05'
                ],
        ]);
    }    

    public function DemoUser(){
        $this->createUserTypeCompany(2,'กนกนันทร์','สุเชาว์อินทร์','ttrsuser1@npcsolution.com','9548853765681','0882514838','ไทยชนะรีสอร์ต');
        $this->createUserTypePersonal(2,'จาริยา','รัชตาธิวัฒน์','ttrsuser2@npcsolution.com','5988162591551','0882514838','หนมเนยลำพูน');
        $this->createUserTypeCompany(1,'อนุรักษ์','พันธ์งามตา','ttrsuser3@npcsolution.com','9955634503731','0882514838','ผัดไทยประตูป่า');
        $this->createUserTypePersonal(1,'พงศกร','สุขปาน','ttrsuser4@npcsolution.com','9908968928636','0882514838','ลาบดีขมลำพูน');
        $this->createUserTypeCompany(2,'พนิตา','สุภาพ','ttrsuser5@npcsolution.com','4789285689287','0882514838','ฟ้าใสหมูกระทะ');
        $this->createUserTypeCompany(2,'มินตรา','รักการดี','ttrsuser6@npcsolution.com','1650719040046','0882514838','ก๋วยเตี๋ยวกะลามัง');
        $this->createUserTypeCompany(2,'สายธาร','สวนจันทร์','ttrsuser7@npcsolution.com','6769198425725','8332571396890','ก๋วยเตี๋ยวไก่ลำพูน');

        $this->createOfficer(2,'จิตราพร','ทองคง','ttrsofficer1@npcsolution.com','4461544270681','0882514838');
        $this->createOfficer(1,'เฉลิมเดช','ประพิณไพโรจน์','ttrsofficer2@npcsolution.com','1535149478362','0882514838');
        $this->createOfficer(1,'ณภัทร','เครือทิวา','ttrsofficer3@npcsolution.com','4238469877497','0882514838');
        $this->createOfficer(2,'ณัฏฐา','สุภาสนันท์','ttrsofficer4@npcsolution.com','5365417853982','0882514838');
        $this->createOfficer(1,'ณัฐพงษ์','ธนโชติเจริญ์','ttrsofficer5@npcsolution.com','5069694503613','0882514838');
        $this->createOfficer(1,'ศรัณย์','ศิริกําเนิด','ttrsofficer6@npcsolution.com','1951196420980','0882514838');
        $this->createOfficer(2,'สุดคนึง','แววสูงเนิน','ttrsofficer7@npcsolution.com','1125545350575','0882514838');
        $this->createOfficer(1,'สุภัทร','สวนจันทร์','ttrsofficer8@npcsolution.com','9085745215457','0882514838');
        $this->createOfficer(2,'อรุณี','มัทนะไพศาล','ttrsofficer9@npcsolution.com','3767342497671','0882514838');
        $this->createOfficer(2,'อาวัชนา','สุขรุ่งเรือง','ttrsofficer10@npcsolution.com','5469655619939','0882514838');

        $this->createExpert(2,'ทวีภรณ์','ศรีสุขคํา','expert1@npcsolution.com','5722071412821','0882514838',1);
        $this->createExpert(1,'ธนาวุฒ','อาจกิจโกศล','expert2@npcsolution.com','7679341031763','0882514838',1);
        $this->createExpert(1,'ธิติพันธุ์','วิชัยยา','expert3@npcsolution.com','6656955610531','0882514838',1);
        $this->createExpert(2,'นิภาลัย','อริยชัยกุล','expert4@npcsolution.com','3752824031172','0882514838',1);
        $this->createExpert(2,'ปฐวีณา','แก้วแจ้ง','expert5@npcsolution.com','3616568974934','0882514838',1);
        $this->createExpert(2,'สุทิศา','ทับเหล็ก','expert6@npcsolution.com','3000237213103','0882514838',1);

        $this->createExpert(2,'อรุณรัตน์','อาวัชนากร','expert7@npcsolution.com','1971486135480','0882514838',2);
        $this->createExpert(2,'สุหฤทัย','เดชอุป','expert8@npcsolution.com','3075089204513','0882514838',2);
        $this->createExpert(2,'สุขสันต์','ไชยรัตน์','expert9@npcsolution.com','7561895470261','0882514838',2);
        $this->createExpert(2,'สิริพงษ์','กุลสุขรังสรรค์','expert10@npcsolution.com','8688825124759','0882514838',2);
        
    }

    public function DemoUserTEST(){
        $this->createUserTypeCompany(2,'อำไพพรรณ','ผ่องลำพูน','ttrsuser2020@gmail.com','9750815350896','851547196','เกรียงไกรทัวร์');
        $this->createUserTypeCompany(2,'ตัง','เม','ttrsusertwo2020@gmail.com','2513813143742','942495240','กรีนทีคอฟฟี่');
        $this->createUserTypeCompany(2,'จินดา','มณีสุข','ttrsuser1@gmail.com','1394623834048','530932544','');
        $this->createUserTypeCompany(2,'พชรกร','เกียรติขจรก้องไพศาล','pimpisa@nstda.or.th','7620587386519','811234567','2P Food and Bev');
        $this->createUserTypeCompany(2,'ผู้ประกอบการPN','คนงาม','ttrsexpertone2020@gmail.com','1284536706883','819559952','');
        $this->createUserTypeCompany(2,'ผู้ประกอบการPN','คนเดิม','nunu12nana12@gmail.com','1428747545181','811111111','บริษัท พีเอ็นPN จำกัด');
        $this->createUserTypeCompany(2,'ทีวี','ทีวีจี','tvcompany35@gmail.com','3362365999117','635323995','ทีวี');
        $this->createUserTypeCompany(2,'วิลาวัลย์','กลอบอไรเซชั่น','m_u_ka23@yahoo.com','2461647059138','0851547196','Global Seed Growing');
        $this->createUserTypeCompany(2,'ตังเม','ไงล่าา','tungmay140@hotmail.com','6073942302437','0942495240','มัทฉะเวอร์ชันอัพเดทจริงเชื่อถือได้');


        $this->createUserTypePersonal(2,'มาดูกัน เปลี่ยนชื่อนะ','ว่ามินิจะได้มั๊ย','ttrscolead2020@gmail.com','4580278441759','812345678','บ้านรักแมว');
        $this->createUserTypePersonal(2,'ใครไม่แอล','แอลแอล กอฮอลิค','pantaree.phu@nstda.or.th','5019338724281','894133661','บริษัท ไอทีบายแอล แอล จำกัด');
        $this->createUserTypePersonal(2,'ซอจอง','จิ้มลิ้ม','chamaiporn.sud@nstda.or.th','7723209799505','055555555','C S Innovation');
        $this->createUserTypePersonal(2,'Leader CS','โครงการนะจ๊ะ','ttrstrial2021@gmail.com','8948045116371','254444444','ชอบดม นิ NI');


        $this->createOfficer(2,'เจ้าหน้าที่เน่ย','เน้ย','ttrsexpertfive2020@gmail.com','2352009432022','819559951');
        $this->createOfficer(2,'ลำธาร','สายน้ำ','ttrsexpertfour2020@gmail.com','6533402990363','0635323995');
        $this->createOfficer(2,'Leader CS','TTRS','ttrsleader2020@gmail.com','1473052267358','877878787');
        $this->createOfficer(2,'เก่งกาจ','เกษตรกรรม','khemratha@gmail.com','7205095547347','851547196');
        $this->createOfficer(2,'เจ้าหน้าที่','KC','kanticha.cha@nstda.or.th','9558745791189','88888888');
        $this->createOfficer(2,'เจ้าหน้าที่ PP','TTRS','staffttrs0986@gmail.com','8639226651256','811234567');
        $this->createOfficer(2,'ลีดดดดดดด','เดอร์','noramon.int@nstda.or.th','3831605889617','053642546');
        $this->createOfficer(2,'เคเค','เปลี่ยนมั่วได้ไง','khemratha@nstda.or.th','8543430945462','0851547196');
        $this->createOfficer(2,'ใครไม่เชี่ยวชาญ','ผู้เชี่ยวชาญแอลแอล','sumlong.tn@gmail.com','9848838655100','0894133662');

        $this->createExpert(2,'ป่าเขา','ลำเนาไพร','ttrsmemberone2020@gmail.com','3024196717858','635323995',1);
        $this->createExpert(2,'ฉันคือผู้เชี่ยวชาญ','กลับมายืนที่เดิม','ttrsexperttwo2020@gmail.com','3904383603978','2111111111',2);
        $this->createExpert(2,'Expert PP','Three','ttrsexpertthree2020@gmail.com','8364247498269','811234555',1);
        
    }

    public function createUserTypeCompany($prefix,$name,$lastname,$email,$hid,$phone,$companyname){
        $user = new User();
        $user->prefix_id = $prefix;
        $user->user_type_id = 1;
        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->password = Hash::make('11111111');
        $user->verify_type = 1;
        $user->email_verified_at = Carbon::now()->toDateString();
        $user->user_group_id = 1;
        $user->phone = $phone;
        $user->save();

        $company = new Company();
        $company->name = $companyname;
        $company->user_id = $user->id;
        $company->vatno = $hid;
        $company->business_type_id = 2;
        $company->save();

        $companyaddress = new CompanyAddress();
        $companyaddress->company_id = $company->id;
        // $companyaddress->province_id = 4;
        // $companyaddress->amphur_id = 67;
        // $companyaddress->tambol_id = 367;
        // $companyaddress->postalcode = '12120';
        $companyaddress->save(); 
    }

    public function createUserTypePersonal($prefix,$name,$lastname,$email,$hid,$phone,$companyname){
        $user = new User();
        $user->prefix_id = $prefix;
        $user->user_type_id = 1;
        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->hid = $hid;
        $user->password = Hash::make('11111111');
        $user->verify_type = 1;
        $user->email_verified_at = Carbon::now()->toDateString();
        $user->user_group_id = 2;
        $user->phone = $phone;
        $user->save();

        $company = new Company();
        $company->name = $companyname;
        $company->user_id = $user->id;
        $company->vatno = $hid;
        $company->business_type_id = 5;
        $company->save();

        $companyaddress = new CompanyAddress();
        $companyaddress->company_id = $company->id;
        // $companyaddress->province_id = 4;
        // $companyaddress->amphur_id = 67;
        // $companyaddress->tambol_id = 367;
        // $companyaddress->postalcode = '12120';
        $companyaddress->save(); 
    }

    public function createOfficer($prefix,$name,$lastname,$email,$hid,$phone){
        $user = new User();
        $user->prefix_id = $prefix;
        $user->user_type_id = 4;
        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->hid = $hid;
        $user->password = Hash::make('11111111');
        $user->verify_type = 1;
        $user->email_verified_at = Carbon::now()->toDateString();
        $user->user_group_id = 2;
        $user->phone = $phone;
        $user->save();

        $company = new Company();
        $company->user_id = $user->id;
        $company->vatno = $hid;
        $company->business_type_id = 5;
        $company->save();

        $companyaddress = new CompanyAddress();
        $companyaddress->company_id = $company->id;
        // $companyaddress->province_id = 4;
        // $companyaddress->amphur_id = 67;
        // $companyaddress->tambol_id = 367;
        // $companyaddress->postalcode = '12120';
        $companyaddress->save(); 

        $officerdetail = new OfficerDetail();
        $officerdetail->user_id = $user->id;
        $officerdetail->save();
    }
    public function createExpert($prefix,$name,$lastname,$email,$hid,$phone,$experttype){
        $user = new User();
        $user->prefix_id = $prefix;
        $user->user_type_id = 3;
        $user->name = $name;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->hid = $hid;
        $user->password = Hash::make('11111111');
        $user->verify_type = 1;
        $user->email_verified_at = Carbon::now()->toDateString();
        $user->user_group_id = 2;
        $user->phone = $phone;
        $user->save();

        $company = new Company();
        $company->user_id = $user->id;
        $company->vatno = $hid;
        $company->business_type_id = 5;
        $company->save();

        $companyaddress = new CompanyAddress();
        $companyaddress->company_id = $company->id;
        // $companyaddress->province_id = 4;
        // $companyaddress->amphur_id = 67;
        // $companyaddress->tambol_id = 367;
        // $companyaddress->postalcode = '12120';
        $companyaddress->save(); 

        $expertdetail = new ExpertDetail();
        $expertdetail->user_id = $user->id;
        $expertdetail->expert_type_id = $experttype;
        $expertdetail->save();
    }

    public function Announce(){
        $directmenu = DirectMenu::find(3);
        $directmenu->update([
            'view' => intVal($directmenu->view) +1
        ]);
        $announces = Announce::where('page_status_id',1)->orderBy('id','desc')->paginate(10);
        $announcecategories = AnnounceCategory::get();
        return view('landing.announce')->withAnnounces($announces)
                                    ->withAnnouncecategories($announcecategories);
    }

    public function announcenews($slug)
    {
        $ip = \Request::getClientIp(true);
        $agent = new Agent();
        $announce = Announce::where('slug',$slug)->first();
        if(Empty($announce)){
            return abort(404);
        }
        $user = "";
        if(Auth::check()){
            $user = Auth::user()->id;
        }
        $announceattachments = AnnounceAttachment::where('announce_id',$announce->id)->get();
        return view('landing.announcenews')->withAnnounce($announce)
                                        ->withAnnounceattachments($announceattachments);
    }

    public function showannounce(Request $request){
       $announces =  Announce::where('announce_category_id',$request->categoryid)->orderBy('id','desc')->get()->each->append('day')->each->append('month')->each->append('year')->each->append('announcecategory');
        return response()->json($announces); 
    }
    public function searchannounce(Request $request){
        $announcearray = Announce::where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%')->pluck('id')->toArray();

        $announces =  Announce::whereIn('id',$announcearray)->orderBy('id','desc')->get()->each->append('day')->each->append('month')->each->append('year')->each->append('announcecategory');
         return response()->json($announces); 
     }
     public function faq(){
        $directmenu = DirectMenu::find(4);
        $directmenu->update([
            'view' => intVal($directmenu->view) +1
        ]);
        $faqs =  Faq::where('status',1)->orderBy('id','desc')->get();
        return view('landing.faq')->withFaqs($faqs);
    }

    public function Test(){
        // $columns = Schema::getColumnListing('full_tbps');
        // return $columns;
        // $tableColumnInfos = DB::select('SHOW FULL COLUMNS FROM business_plans');
        //     foreach ($tableColumnInfos as $tableColumnInfo) {
        //     echo $tableColumnInfo->Field . ' ' . $tableColumnInfo->Comment . '<br>'; 
        // }
        $industrygroups = IndustryGroup::with('companies')->get();
        return  $industrygroups;

        $company = Company::with('industrygroup')->find(3);
        return  $company;
    }

}


