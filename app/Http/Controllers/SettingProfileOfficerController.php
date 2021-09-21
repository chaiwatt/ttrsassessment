<?php

namespace App\Http\Controllers;
use Image;
use App\User;
use Carbon\Carbon;
use App\Helper\Crop;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Model\Company;
use App\Model\Province;
use App\Model\ExpertDoc;
use App\Model\ExpertField;
use App\Model\ExpertBranch;
use App\Model\OfficerDetail;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\EducationLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditOfficerProfile;
use App\Http\Requests\EditProfileExpertRequest;

class SettingProfileOfficerController extends Controller
{
    public function Edit($userid){
        $user = Auth::user();
        $prefixes = Prefix::get();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$user->province_id)->get();
        $tambols = Tambol::where('amphur_id',$user->amphur_id)->get();
        $amphurs1 = Amphur::where('province_id',$user->province1_id)->get();
        $tambols1 = Tambol::where('amphur_id',$user->amphur1_id)->get();
        $officerbanches = ExpertBranch::get();
        $educationlevels = EducationLevel::get();
        $officer = OfficerDetail::where('user_id',$userid)->first();
        $officerfields = ExpertField::where('user_id',$user->id)->orderBy('order','asc')->get();
        $officerdocs = ExpertDoc::where('user_id',$user->id)->get();
        
        return view('setting.profile.officer.edit')->withUser($user)
                                            ->withPrefixes($prefixes)
                                            ->withProvinces($provinces)
                                            ->withAmphurs($amphurs)
                                            ->withTambols($tambols)
                                            ->withAmphurs1($amphurs1)
                                            ->withTambols1($tambols1)
                                            ->withOfficerbanches($officerbanches)
                                            ->withEducationlevels($educationlevels)
                                            ->withOfficer($officer)
                                            ->withOfficerfields($officerfields)
                                            ->withOfficerdocs($officerdocs);
    }
    public function EditSave(EditOfficerProfile $request, $id){
        $auth = Auth::user();
        
        if(!Empty($request->password)){
            $auth->update([
                'password' => Hash::make($request->password)
            ]);
        }
        $user = User::find($auth->id);
        $file = $request->picture; 
        $filelocation = $auth->company->logo;
        if(!Empty($file)){         
            if(!Empty($auth->company->logo)){
                if(strpos($auth->company->logo, 'assets/dashboard/images/user.png') != false){
                    @unlink($auth->company->logo);
                }
            }
            $name = $file->getClientOriginalName();
            $file = $request->picture;
            $img = Image::make($file);  
            $fname=str_random(10).".".$file->getClientOriginalExtension();
            $filelocation = "storage/uploads/company/".$fname;
            Crop::crop(true,public_path("storage/uploads/company/"),$fname,Image::make($file),500,500,1);
        }
        if(Empty($request->sameaddress)){
            $user->update([
                'prefix_id' => $request->prefix,
                'alter_prefix' => $request->alter_prefix,
                'name' => $request->name,
                'hid' => $request->hid,
                'lastname' => $request->lastname,
                'picture' => $filelocation,
                'address' => $request->address,
                'province_id' => $request->province,
                'amphur_id' => $request->amphur,
                'tambol_id' => $request->tambol,
                'postal' => $request->postalcode,
                'address1' => $request->address1,
                'province1_id' => $request->province1,
                'amphur1_id' => $request->amphur1,
                'tambol1_id' => $request->tambol1,
                'postal1' => $request->postalcode1,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'website' => $request->website,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
        }else{
            $user->update([
                'prefix_id' => $request->prefix,
                'alter_prefix' => $request->alter_prefix,
                'name' => $request->name,
                'hid' => $request->hid,
                'lastname' => $request->lastname,
                'picture' => $filelocation,
                'address' => $request->address,
                'province_id' => $request->province,
                'amphur_id' => $request->amphur,
                'tambol_id' => $request->tambol,
                'postal' => $request->postalcode,
                'address1' => $request->address,
                'province1_id' => $request->province,
                'amphur1_id' => $request->amphur,
                'tambol1_id' => $request->tambol,
                'postal1' => $request->postalcode,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'website' => $request->website,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
        }

        OfficerDetail::where('user_id',$auth->id)->first()->update([
            'position' => $request->position,
            'organization' => $request->organization,
            'education_level_id' => $request->educationlevel,
            'officer_branch_id' => $request->expertbranch,
            'other_branch' => $request->other_branch,
            'expereinceyear' => $request->expereinceyear,
            'expereincemonth' => $request->expereincemonth
        ]);
        Company::where('user_id',$auth->id)->first()->update([
            'saveprofile' => 1,
            'logo' => $filelocation,
        ]);
        CreateUserLog::createLog('แก้ไขข้อมูลProfile');
        return redirect()->back()->withSuccess('แก้ไขข้อมูลส่วนตัวสำเร็จ'); 
    }
}


