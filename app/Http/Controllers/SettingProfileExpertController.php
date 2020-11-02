<?php

namespace App\Http\Controllers;
use Image;
use App\User;
use Carbon\Carbon;
use App\Model\Isic;
use App\Helper\Crop;
use App\Model\Amphur;
use App\Model\Prefix;
use App\Model\Tambol;
use App\Model\Company;
use App\Model\IsicSub;
use App\Model\Province;
use App\Model\ExpertDoc;
use App\Model\ExpertField;
use App\Model\ExpertBranch;
use App\Model\ExpertDetail;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use App\Model\EducationLevel;
use App\Model\FullTbpCompanyDoc;
use App\Model\AuthorizedDirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EditProfileExpertRequest;

class SettingProfileExpertController extends Controller
{
    public function Edit($userid){
        $user = Auth::user();
        $prefixes = Prefix::get();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$user->province_id)->get();
        $tambols = Tambol::where('amphur_id',$user->amphur_id)->get();
        $amphurs1 = Amphur::where('province_id',$user->province1_id)->get();
        $tambols1 = Tambol::where('amphur_id',$user->amphur1_id)->get();
        $expertbranches = ExpertBranch::get();
        $educationlevels = EducationLevel::get();
        $expert = ExpertDetail::where('user_id',$userid)->first();
        $expertfields = ExpertField::where('user_id',$user->id)->get();
        $expertdocs = ExpertDoc::where('user_id',$user->id)->get();
        return view('setting.profile.expert.edit')->withUser($user)
                                            ->withPrefixes($prefixes)
                                            ->withProvinces($provinces)
                                            ->withAmphurs($amphurs)
                                            ->withTambols($tambols)
                                            ->withAmphurs1($amphurs1)
                                            ->withTambols1($tambols1)
                                            ->withExpertbranches($expertbranches)
                                            ->withEducationlevels($educationlevels)
                                            ->withExpert($expert)
                                            ->withExpertfields($expertfields)
                                            ->withExpertdocs($expertdocs);
    }
    public function EditSave(EditProfileExpertRequest $request, $id){
        $auth = Auth::user();
        if(!Empty($request->password)){
            $auth->update([
                'password' => Hash::make($request->password)
            ]);
        }
        $user = User::find($auth->id);
        if(!Empty($request->password)){
            $user->update([
                'password' => Hash::make($request->password)
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
            $filelocation = "storage/uploads/company/".$fname;
            Crop::crop(true,public_path("storage/uploads/company/"),$fname,Image::make($file),500,500,1);
        }

        $user->update([
            'prefix_id' => $request->prefix,
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

        ExpertDetail::where('user_id',$auth->id)->first()->update([
            'position' => $request->position,
            'organization' => $request->organization,
            'education_level_id' => $request->educationlevel,
            'expert_branch_id' => $request->expertbranch,
            'expereinceyear' => $request->expereinceyear,
            'expereincemonth' => $request->expereincemonth
        ]);

        return redirect()->back()->withSuccess('แก้ไขข้อมูลส่วนตัวสำเร็จ'); 
    }
}

