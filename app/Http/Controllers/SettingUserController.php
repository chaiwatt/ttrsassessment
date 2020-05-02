<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Model\Prefix;
use App\Model\UserType;
use App\Model\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;

class SettingUserController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        // 1=admin, 2=expert, 3=company 
        $this->middleware('role:1'); 
    }
    public function Index(){
        $users = User::where('id','!=',Auth::user()->id)->get();
        return view('setting.user.index')->withUsers($users);
    }
    public function Create(){
        $prefixes = Prefix::get();
        $usertypes = UserType::get();
        $userstatuses = UserStatus::get();
        return view('setting.user.create')->withPrefixes($prefixes)
                                    ->withUsertypes($usertypes)
                                    ->withUserstatuses($userstatuses);
    }
    public function CreateSave(CreateUserRequest $request){
        $user = new User();
        $user->prefix_id = $request->prefix;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->user_type_id = $request->usertype;
        $user->user_status_id = $request->userstatus;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at =  Carbon::now()->toDateString();
        $user->verify_type =  1 ;
        $user->save();

        return redirect()->route('setting.user')->withSuccess('เพิ่มผู้ใช้งานสำเร็จ');
    }

    public function Edit($id){
        $prefixes = Prefix::get();
        $usertypes = UserType::get();
        $userstatuses = UserStatus::get();
        $user = User::find($id);
        return view('setting.user.edit')->withPrefixes($prefixes)
                                    ->withUsertypes($usertypes)
                                    ->withUserstatuses($userstatuses)
                                    ->withUser($user);
    }
    public function EditSave(CreateUserRequest $request,$id){
        $user = User::find($id);
        if(!Hash::check( $request->password,$user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }
        User::find($id)->update([
            'prefix_id' => $request->prefix,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'user_type_id' => $request->usertype,
            'user_status_id' => $request->userstatus,
            'email' => $request->email
        ]);
        return redirect()->route('setting.user')->withSuccess('แก้ไขผู้ใช้งานสำเร็จ');
    }
    public function Delete($id){
        User::find($id)->delete();
        return redirect()->route('setting.user')->withSuccess('ลบผู้ใช้งานสำเร็จ');
    }

    public function Profile(){
        return view('setting.user.profile');
    }
}
