<?php

namespace App\Http\Controllers;
use Image;
use App\Helper\Crop;
use App\Model\Amphur;
use App\Model\Tambol;
use App\Model\Province;
use App\Model\ShowAlert;
use App\Model\GeneralInfo;
use Illuminate\Http\Request;
use App\Helper\CreateUserLog;
use App\Model\FrontPageStatus;
use App\Model\UseInvoiceStatus;
use App\Model\VerifyExpertStatus;
use App\Model\ShowFinishedProject;
use Illuminate\Support\Facades\Auth;

class SettingAdminSystemController extends Controller
{
    public function Index(){
        $generalinfo = GeneralInfo::first();
        $frontpagestatuses = FrontPageStatus::get();
        $auth = Auth::user();
        $provinces = Province::get();
        $amphurs = Amphur::where('province_id',$generalinfo->province_id)->get();
        $tambols = Tambol::where('amphur_id',$generalinfo->amphur_id)->get();
        $useinvoicestatuses = UseInvoiceStatus::get();
        
        $verifyexpertstatuses = VerifyExpertStatus::get();
        $showalerts = ShowAlert::get();
        $showfinishedprojects = ShowFinishedProject::get();
        return view('setting.admin.system.index')->withProvinces($provinces)
                                                ->withAmphurs($amphurs)
                                                ->withTambols($tambols)
                                                ->withGeneralinfo($generalinfo)
                                                ->withFrontpagestatuses($frontpagestatuses)
                                                ->withVerifyexpertstatuses($verifyexpertstatuses)
                                                ->withUseinvoicestatuses($useinvoicestatuses)
                                                ->withShowalerts($showalerts)
                                                ->withShowfinishedprojects($showfinishedprojects);
    }
    public function Save(Request $request){
        //$request->submit ;
        // return $request->submit ;
        if($request->submit == 'save'){
            if(Empty($request->director)){
                return redirect()->back()->withError('ผู้อำนวยการ/ผู้มีอำนาจลงนาม');
            }
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
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'instagram' => $request->instagram,
                'showsocialmedia' => $request->showsocialmedia,
                'workdaytime' => $request->workdaytime,
                'sundaytime' => $request->sundaytime,
                'front_page_status_id' => $request->frontpage,
                'verify_expert_status_id' => $request->verifyexpert,
                'consent' => $request->consent,
                'director' => $request->director,
                'showalert_id' => $request->showalert,
                'watermark' => $request->watermark,
                'use_invoice_status_id' => $request->useinvoicestatus,
                'phone1_ext' => $request->phone1_ext,
                'showgradeperpillar' => $request->showgradeperpillar,
                'showgradeperbusinesssize' => $request->showgradeperbusinesssize,
                'showgradepersection' => $request->showgradepersection,
                'showgradeperbusinesstype' => $request->showgradeperbusinesstype,
                'showgradeperindustrygroup' => $request->showgradeperindustrygroup,
                'showgradeperisic' => $request->showgradeperisic,
                // 'show_finished_project_id' => $request->showfinishedproject,
                'watermarktext' => $request->watermarktext
            ]);
            CreateUserLog::createLog('แก้ไขการตั้งค่าระบบ');
            return redirect()->back()->withSuccess('แก้ไขสำเร็จ');
        }else{
            $generalinfo = GeneralInfo::first();
            GeneralInfo::first()->update([
                'company' => $generalinfo->company_default,
                'phone1' => $generalinfo->phone1_default,
                'phone2' => $generalinfo->phone2_default,
                'fax' => $generalinfo->fax_default,
                'email' => $generalinfo->email_default,
                'address' => $generalinfo->address_default,
                'province_id' => $generalinfo->province_default_id,
                'amphur_id' => $generalinfo->amphur_default_id,
                'tambol_id' => $generalinfo->tambol_default_id,
                'postalcode' => $generalinfo->postalcode_default,
                'facebook' => $generalinfo->facebook_default,
                'workdaytime' => $generalinfo->workdaytime_default,
                'director' => $generalinfo->director_default,
                'showalert_id' => 1,
                'front_page_status_id' => $generalinfo->front_page_status_default_id,
                'verify_expert_status_id' => $generalinfo->verify_expert_default_status_id,
                'watermark' => $generalinfo->watermark_default,
                // 'show_finished_project_id' => 1,
                'use_invoice_status_id' => $generalinfo->use_invoice_status_default_id,
            ]);
            CreateUserLog::createLog('แก้ไขการตั้งค่าระบบ (ค่า Default)');
            return redirect()->back()->withSuccess('แก้ไขสำเร็จ (ค่า Default)');
        }
        
    }
  
}
