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


