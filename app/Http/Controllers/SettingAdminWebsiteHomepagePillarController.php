<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\HomepagePillar;
use App\Http\Requests\EditHomePagePillarRequest;

class SettingAdminWebsiteHomepagePillarController extends Controller
{
    public function Edit(){
        $homepagepillar = HomepagePillar::first();
        return view('setting.admin.website.homepage.pillar.edit')->withHomepagepillar($homepagepillar);
    }
    public function EditSave(EditHomePagePillarRequest $request){
        $homepagepillar = HomepagePillar::first();
        $filelocation_pillarimage1 = $homepagepillar->pillarimage1;
        $filelocation_pillarimage2 = $homepagepillar->pillarimage2;
        $filelocation_pillarimage3 = $homepagepillar->pillarimage3;
        $filelocation_pillarimage4 = $homepagepillar->pillarimage4;

        $file_pillarimage1 = $request->file('pillarimage1');
        $file_pillarimage2 = $request->file('pillarimage2');
        $file_pillarimage3 = $request->file('pillarimage3');
        $file_pillarimage4 = $request->file('pillarimage4');

        if(!Empty($file_pillarimage1)){
            unlink($homepagepillar->pillarimage1);
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/pillarimage" , $new_name);
            $filelocation_pillarimage1 = "storage/uploads/pillarimage/".$new_name;
        }
        if(!Empty($file_pillarimage2)){
            unlink($homepagepillar->pillarimage2);
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/pillarimage" , $new_name);
            $filelocation_pillarimage2 = "storage/uploads/pillarimage/".$new_name;
        }
        if(!Empty($file_pillarimage3)){
            unlink($homepagepillar->pillarimage3);
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/pillarimage" , $new_name);
            $filelocation_pillarimage3 = "storage/uploads/pillarimage/".$new_name;
        }
        if(!Empty($file_pillarimage4)){
            unlink($homepagepillar->pillarimage4);
            $new_name = str_random(10).".".$file->getClientOriginalExtension();
            $file->move("storage/uploads/pillarimage" , $new_name);
            $filelocation_pillarimage4 = "storage/uploads/pillarimage/".$new_name;
        }

        $homepagepillar = HomepagePillar::first()->update([
            'headerthai' => $request->headerthai,
            'headereng' => $request->headereng,
            'descriptionthai' => $request->descriptionthai,
            'descriptioneng' => $request->descriptioneng,
            'pillarimage1' => $filelocation_pillarimage1,
            'pillarimage2' => $filelocation_pillarimage2,
            'pillarimage3' => $filelocation_pillarimage3,
            'pillarimage4' => $filelocation_pillarimage4
        ]);
        return redirect()->route('setting.admin.website.homepage.pillar')->withSuccess('แก้ไข Pillar สำเร็จ');
    }
    
}
