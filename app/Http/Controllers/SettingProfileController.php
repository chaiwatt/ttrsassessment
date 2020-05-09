<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Amphur;
use App\Model\Friend;
use App\Model\Prefix;
use App\Model\Tambol;
use App\UserPosition;
use App\Model\Country;
use App\Model\Province;
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
                                        ->withMessagereceives($messagereceives);
    }
}
