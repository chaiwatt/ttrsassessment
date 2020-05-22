<?php

namespace App\Http\Controllers;
use Image;
use App\User;
use App\Helper\Crop;
use App\Model\Amphur;
use App\Model\Friend;
use App\Model\Prefix;
use App\Model\Tambol;
use App\UserPosition;
use App\Model\Country;
use App\Model\Province;
use App\Model\GeneralInfo;
use App\Model\VerifyStatus;
use App\Model\FriendRequest;
use Illuminate\Http\Request;
use App\Model\EducationLevel;
use App\Model\MessageReceive;
use App\Model\EducationBranch;
use App\Model\ExpertEducation;
use App\Model\MessagePriority;
use App\Model\ExpertExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditProfileRequest;

class SettingProfileController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1,2,3'); 
    }
    public function Edit($userid){
        $auth = Auth::user();
        $educationlevels = EducationLevel::get();
        $educationbranches = EducationBranch::get();
        $countries = Country::get();
        $auth = Auth::user();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$auth->province_id)->get();
        $tambols = Tambol::where('amphur_id',$auth->amphur_id)->get();
        $prefixes = Prefix::get();
        $user = User::find($userid);
        $userpositions = UserPosition::get();
        $verifystatuses = VerifyStatus::get();
        $messagepriorities = MessagePriority::get();
        $users = User::get();
        $friends = Friend::where('user_id',$auth->id)->get();
        $friendrequests = FriendRequest::where('from_id',$auth->id)->get();
        $friendrequestcomings = FriendRequest::where('to_id',$auth->id)->get();
        $messagereceives = MessageReceive::where('receiver_id',$auth->id)->paginate(10);
        $unreadmessages = MessageReceive::where('receiver_id',$auth->id)->where('message_read_status_id',1)->get();
        $generalinfo = GeneralInfo::first();
        $experteducations = ExpertEducation::where('user_id',$auth->id)->get();
        $expertexperiences = ExpertExperience::where('user_id',$auth->id)->get();
        return view('setting.profile.edit')->withUser($user)
                                        ->withPrefixes($prefixes)
                                        ->withProvinces($provinces)
                                        ->withAmphurs($amphurs)
                                        ->withTambols($tambols)
                                        ->withUserpositions($userpositions)
                                        ->withEducationlevels($educationlevels)
                                        ->withEducationbranches($educationbranches)
                                        ->withCountries($countries)
                                        ->withVerifystatuses($verifystatuses)
                                        ->withMessagepriorities($messagepriorities)
                                        ->withUsers($users)
                                        ->withFriends($friends)
                                        ->withFriendrequests($friendrequests)
                                        ->withFriendrequestcomings($friendrequestcomings)
                                        ->withMessagereceives($messagereceives)
                                        ->withUnreadmessages($unreadmessages)
                                        ->withGeneralinfo($generalinfo)
                                        ->withExperteducations($experteducations)
                                        ->withExpertexperiences($expertexperiences);
    }
    public function EditSave(EditProfileRequest $request, $userid){
        if($request->action == 'personal'){
            $user = User::find($userid);
            if(!Empty($request->password)){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }
            $email = $user->email;
            if(!Empty($request->email) && $email != $request->email){
                $user->update([
                    'email' => $request->email
                ]);
            }
            $file = $request->picture; 
            $filelocation = $user->picture;
            if(!Empty($file)){         
                if(!Empty($user->picture)){
                    @unlink($user->picture);
                }
                $name = $file->getClientOriginalName();
                $file = $request->picture;
                $img = Image::make($file);  
                $fname=str_random(10).".".$file->getClientOriginalExtension();
                $filelocation = "storage/uploads/profile/".$fname;
                // $this->crop(true,public_path("storage/uploads/profile/"),$fname,Image::make($file),500,500,1);
                Crop::crop(true,public_path("storage/uploads/profile/"),$fname,Image::make($file),500,500,1);
            }
            $user->update([
                'prefix_id' => $request->prefix,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'user_position_id' => $request->userposition,
                'address' => $request->address,
                'phone' => $request->phone,
                'picture' => $filelocation,
            ]);
            return redirect()->back()->withSuccess('แก้ไขข้อมูลส่วนตัวสำเร็จ');
        }else if($request->action == 'expert'){
            if(!Empty($request->expertexpienceposition) && !Empty($request->expertexpiencecompany) 
            && !Empty($request->expertexpiencedetail) && !Empty($request->fromyear) && !Empty($request->toyear)){
                foreach( $request->expertexpienceposition as $key => $expertexpienceposition ){
                    $expertexperience = new ExpertExperience();
                    $expertexperience->user_id = Auth::user()->id;
                    $expertexperience->position = $request->expertexpienceposition[$key];
                    $expertexperience->company = $request->expertexpiencecompany[$key];
                    $expertexperience->jobdetail = $request->expertexpiencedetail[$key];
                    $expertexperience->fromyear = $request->fromyear[$key];
                    $expertexperience->toyear = $request->toyear[$key];
                    $expertexperience->save();                
                }
            }
            if(!Empty($request->educationlevel) && !Empty($request->educationbranch) 
            && !Empty($request->institute) && !Empty($request->country) && !Empty($request->graduatedyear)){
                foreach( $request->educationlevel as $key => $educationlevel ){
                    $experteducation = new ExpertEducation();
                    $experteducation->user_id = Auth::user()->id;
                    $experteducation->education_level_id = $request->educationlevel[$key];
                    $experteducation->education_branch_id = $request->educationbranch[$key];
                    $experteducation->institute = $request->institute[$key];
                    $experteducation->country_id = $request->country[$key];
                    $experteducation->graduatedyear = $request->graduatedyear[$key];
                    $experteducation->save();                
                }
            }
            return redirect()->back()->withSuccess('แก้ไขข้อมูลส่วนตัวสำเร็จ');
        }else if($request->action == 'organization'){
            return 'ข้อมูลหน่วยงาน';
        }
    }
    public function crop($isvertical,$path,$fname,$img,$width,$height,$offset){
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if($isvertical == true){
            $_width = $width*$offset; 
            $_height = $height*$offset; 
            $img->height() > $img->width() ? $_width=null : $_height=null;
            $img->resize($_width, $_height, function ($constraint) {
                $constraint->aspectRatio();
            })->crop($width, $height)->save($path.$fname);
        }else{
            $_width = $width*$offset; 
            $_height = $height*$offset; 
            $img->resize(null, $_height, function ($constraint) {
                $constraint->aspectRatio();
            })->crop($width, $height)->save($path.$fname);
        }
        return;
    }
}
