<?php

namespace App\Http\Controllers\Api;

use App\Model\Company;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\SoundDexApi;
use App\Model\BusinessPlan;
use App\Model\ProjectGrade;
use Illuminate\Http\Request;
use App\Model\ExpertAssignment;
use App\Model\ProjectAssignment;
use App\Http\Controllers\Controller;

class SearchProjectController extends Controller
{
    public function Year(Request $request){
       
      if($request->year != 0){
        $minitbpids = MiniTBP::whereNotNull('submitdate')->whereYear('created_at', ($request->year-543))->pluck('id')->toArray();
      }else{
        $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
      }
      $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
      return response()->json($fulltbps); 
    }

    public function ProjectName(Request $request){
        if(Empty($request->projectname)){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json(array(
                "fulltbps" => $fulltbps,
                "soundex" => []
            ));
        } 

        if($request->issounddex == 'false'){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->where('project', 'like', '%' . $request->projectname . '%')
                                ->orWhere('projecteng', 'like', '%' . $request->projectname . '%')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json(array(
                "fulltbps" => $fulltbps,
                "soundex" => []
            ));
        }else{
            $wordtype = 'royin';
            if($request->sounddextype == 2){
                $wordtype = 'personname';
            }
            $randomapi = SoundDexApi::inRandomOrder()->first();
            $curl = curl_init();
            $search = $request->projectname;
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.aiforthai.in.th/soundex?word=".$search."&model=".$wordtype,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Apikey: $randomapi->api"
                )
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return response()->json(array(
                    "fulltbps" => [],
                    "soundex" => []
                ));
            } else {
                $objs = json_decode($response);
                $appendtext = $request->projectname;
                $minitbparray = MiniTBP::whereNotNull('submitdate')->where(function($query) use($objs,$appendtext){
                        foreach($objs->words as $obj){
                            $query->orWhere('project', 'LIKE', '%'.$obj->word.'%');
                        }
                        $query->orWhere('project', 'LIKE', '%'.$appendtext.'%');
                    })->pluck('id')->toArray();
            }
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbparray)->get();

        return response()->json(array(
            "fulltbps" => $fulltbps,
            "soundex" => $objs->words
        ));

    }
    }

    public function CompanyName(Request $request){
        if(Empty($request->companyname)){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json(array(
                "fulltbps" => $fulltbps,
                "soundex" => []
            ));
        } 

        if($request->issounddex == 'false'){
            $companyids = Company::where('name', 'like', '%' . $request->companyname . '%')->pluck('id')->toArray();
            $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
            $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json(array(
                "fulltbps" => $fulltbps,
                "soundex" => []
            ));
        }else{
            
                $wordtype = 'royin';
                if($request->sounddextype == 2){
                    $wordtype = 'personname';
                }
                $randomapi = SoundDexApi::inRandomOrder()->first();
                $curl = curl_init();
                $search = $request->companyname;
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.aiforthai.in.th/soundex?word=".$search."&model=".$wordtype,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Apikey: $randomapi->api"
                    )
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    return response()->json(array(
                        "fulltbps" => [],
                        "soundex" => []
                    ));
                } else {
                    $objs = json_decode($response);
                    $appendtext = $request->companyname;
                    $companyidarray = Company::where(function($query) use($objs,$appendtext){
                            foreach($objs->words as $obj){
                                $query->orWhere('name', 'LIKE', '%'.$obj->word.'%');
                            }
                            $query->orWhere('name', 'LIKE', '%'.$appendtext.'%');
                        })->pluck('id')->toArray();
                }

                // $companyids = Company::where('name', 'like', '%' . $request->companyname . '%')->pluck('id')->toArray();
                $businessplanids = BusinessPlan::whereIn('company_id', $companyidarray)->pluck('id')->toArray();
                $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
                $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();

            return response()->json(array(
                "fulltbps" => $fulltbps,
                "soundex" => $objs->words
            ));
        }

    }

    public function DocNo(Request $request){
        if(Empty($request->docno)){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        }else{
            $fulltbps = FullTbp::whereNotNull('submitdate')->where('fulltbp_code', 'like', '%' . $request->docno . '%')->get();
            return response()->json($fulltbps); 
        } 

        // $minitbpids = MiniTBP::whereNotNull('submitdate')->where('minitbp_code', 'like', '%' . $request->docno . '%')->pluck('id')->toArray();
        // $fulltbpids1 = FullTbp::whereIn('mini_tbp_id', $minitbpids)->pluck('id')->toArray();
        // $fulltbpids2 = FullTbp::where('fulltbp_code', 'like', '%' . $request->docno . '%')->pluck('id')->toArray();
        // $fulltbpiduniques = array_unique(array_merge($fulltbpids1,$fulltbpids2));
        // $fulltbps = FullTbp::whereNotNull('submitdate')->whereIn('id', $fulltbpiduniques)->get();

      
    }

    public function Isic(Request $request){
        if($request->isic == 0){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        }else{
            $companyids = Company::where('isic_id', $request->isic)->pluck('id')->toArray();
            $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
            $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        } 


    }

    public function IndustryGroup(Request $request){
        if($request->industrygroup == 0){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        } else{
            $companyids = Company::where('industry_group_id', $request->industrygroup)->pluck('id')->toArray();
            $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
            $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        }

    }

    public function Leader(Request $request){
        if($request->leader == 0){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        } 
        $projectassignmentids = ProjectAssignment::where('leader_id', $request->leader)->pluck('business_plan_id')->toArray();
        $businessplanuniqueids = array_unique($projectassignmentids);
        $businessplanids = BusinessPlan::whereIn('id', $businessplanuniqueids)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json($fulltbps); 
    }
    
    public function Expert(Request $request){
        if($request->expert == 0){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        } 
        $expertassignmentids = ExpertAssignment::where('user_id', $request->expert)->pluck('full_tbp_id')->toArray();
        $fulltbpuniqueids = array_unique($expertassignmentids);
        $fulltbps = FullTbp::whereIn('id', $fulltbpuniqueids)->get();
        return response()->json($fulltbps); 
    }

    public function Grade(Request $request){
        // dd($request->grade);
        if($request->grade == "=== เลือกทั้งหมด ==="){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        } else{
            $projectgradeids = ProjectGrade::where('grade', $request->grade)->pluck('full_tbp_id')->toArray();
            $fulltbpuniqueids = array_unique($projectgradeids);
            $fulltbps = FullTbp::whereIn('id', $fulltbpuniqueids)->get();
            return response()->json($fulltbps); 
        }
    
    }
    public function RegisteredCapital(Request $request){
        if($request->registeredcapital == 0){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->pluck('id')->toArray();
            $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            return response()->json($fulltbps); 
        } 
        $companyids = Company::where('registeredcapitaltype', $request->registeredcapital)->pluck('id')->toArray();
        $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
        $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
        $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
        return response()->json($fulltbps); 
    }
    
}