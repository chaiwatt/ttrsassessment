<?php

namespace App\Http\Controllers;
use Image;
use App\Helper\Crop;
use App\Model\Amphur;
use App\Model\Tambol;
use App\Model\Province;
use App\Model\GeneralInfo;
use Illuminate\Http\Request;
use App\Model\FrontPageStatus;
use App\Model\VerifyExpertStatus;
use Illuminate\Support\Facades\Auth;

class SettingAdminSystemController extends Controller
{
    public function Index(){
        $generalinfo = GeneralInfo::first();
        $auth = Auth::user();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$generalinfo->province_id)->get();
        $tambols = Tambol::where('amphur_id',$generalinfo->amphur_id)->get();
       
        $frontpagestatuses = FrontPageStatus::get();
        $verifyexpertstatuses = VerifyExpertStatus::get();
        return view('setting.admin.system.index')->withProvinces($provinces)
                                                ->withAmphurs($amphurs)
                                                ->withTambols($tambols)
                                                ->withGeneralinfo($generalinfo)
                                                ->withFrontpagestatuses($frontpagestatuses)
                                                ->withVerifyexpertstatuses($verifyexpertstatuses);
    }
    public function Save(Request $request){
        $generalinfo = GeneralInfo::first();
        $file = $request->picture; 
        $filelocation = $generalinfo->logo;
        if(!Empty($file)){   
            $extension_picture = array('jpg' , 'JPG' , 'jpeg' , 'JPEG' , 'GIF' , 'gif' , 'PNG' , 'png');     
            if( in_array($file->getClientOriginalExtension(), $extension_picture) ){
                if(!Empty($generalinfo->logo)){
                    @unlink($generalinfo->logo);
                }
                $name = $file->getClientOriginalName();
                $file = $request->picture;
                $img = Image::make($file);  
                $fname=str_random(10).".".$file->getClientOriginalExtension();
                $filelocation = "storage/uploads/organize/".$fname;
                Crop::crop(true,public_path("storage/uploads/organize/"),$fname,Image::make($file),274,99,1);
            }else{
                return redirect()->back()->withError('รูปแบบไฟล์โลโก้ไม่ถูกต้อง'); 
            }
        }
        GeneralInfo::first()->update([
            'company' => $request->organizationname,
            'logo' => $filelocation,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'fax' => $request->organizationfax,
            'email' => $request->organizationemail,
            'address' => $request->organizationaddress,
            'province_id' => $request->organizationprovince,
            'amphur_id' => $request->organizationamphur,
            'tambol_id' => $request->organizationtambol,
            'postalcode' => $request->organizationpostalcode,
            'youtube' => $request->youtube,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'skype' => $request->skype,
            'linkedin' => $request->linkedin,
            'workdaytime' => $request->workdaytime,
            'sundaytime' => $request->sundaytime,
            'front_page_status_id' => $request->frontpage,
            'verify_expert_status_id' => $request->verifyexpert,
            'consent' => $request->consent,
            'director' => $request->director,
            'watermark' => $request->watermark,
            'watermarktext' => $request->watermarktext
        ]);
        return redirect()->back()->withSuccess('แก้ไขสำเร็จ');
    }
}
