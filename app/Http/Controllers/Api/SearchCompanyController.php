<?php

namespace App\Http\Controllers\Api;

use App\User;
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


class SearchCompanyController extends Controller
{
    public function ProjectName(Request $request){
        if(Empty($request->projectname)){
            $userarr = User::where('user_type_id',1)->pluck('id')->toArray();
            $companies = Company::whereIn('user_id',$userarr)->get();
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname'),
                "soundex" => []
            ));
        } 

        if($request->issounddex == 'false'){
            $minitbpids = MiniTBP::whereNotNull('submitdate')->where('project', 'like', '%' . $request->projectname . '%')
                                ->orWhere('projecteng', 'like', '%' . $request->projectname . '%')->pluck('id')->toArray();
            
            $businessplans = BusinessPlan::whereIn('id',$minitbpids)->get();
            $companyarr = array();
            $companyarr_unique = array();
            foreach ($businessplans as $key => $businessplan) {
                array_push($companyarr,$businessplan->company_id);
            }
           $companyarr_unique = array_unique($companyarr);
           $companies = Company::whereIn('id',$companyarr_unique)->get();
                 
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname'),
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
                    "companies" => [],
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
            $businessplans = BusinessPlan::whereIn('id',$minitbparray)->get();
            $companyarr = array();
            $companyarr_unique = array();
            foreach ($businessplans as $key => $businessplan) {
                array_push($companyarr,$businessplan->company_id);
            }

            $companyarr_unique = array_unique($companyarr);
            $companies = Company::whereIn('id',$companyarr_unique)->get();
        return response()->json(array(
            "companies" => $companies->each->append('minitbpbelong')->each->append('fullname'),
            "soundex" => $objs->words
        ));

    }

    }

    public function CompanyName(Request $request){
        if(Empty($request->companyname)){
            $userarr = User::where('user_type_id',1)->pluck('id')->toArray();
            $companies = Company::whereIn('user_id',$userarr)->get();
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname'),
                "soundex" => []
            ));
        } 
        if($request->issounddex == 'false'){
            $companyids = Company::where('name', 'like', '%' . $request->companyname . '%')->pluck('id')->toArray();
            $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
            $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();

            $businessplans = BusinessPlan::whereIn('id',$minitbpids)->get();
            $companyarr = array();
            $companyarr_unique = array();
            foreach ($businessplans as $key => $businessplan) {
                array_push($companyarr,$businessplan->company_id);
            }
            $companyarr_unique = array_unique($companyarr);
            $companies = Company::whereIn('id',$companyarr_unique)->get();

            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname'),
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
                // $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();

                $businessplans = BusinessPlan::whereIn('id',$minitbpids)->get();
                $companyarr = array();
                $companyarr_unique = array();
                foreach ($businessplans as $key => $businessplan) {
                    array_push($companyarr,$businessplan->company_id);
                }
                $companyarr_unique = array_unique($companyarr);
                $companies = Company::whereIn('id',$companyarr_unique)->get();

            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname'),
                "soundex" => $objs->words
            ));
        }

    }

    public function Isic(Request $request){
        if($request->isic == 0){
            $userarr = User::where('user_type_id',1)->pluck('id')->toArray();
            $companies = Company::whereIn('user_id',$userarr)->get();
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname')
            ));
        }else{
            $companyids = Company::where('isic_id', $request->isic)->pluck('id')->toArray();
            $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
            $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();

            $businessplans = BusinessPlan::whereIn('id',$minitbpids)->get();
            $companyarr = array();
            $companyarr_unique = array();
            foreach ($businessplans as $key => $businessplan) {
                array_push($companyarr,$businessplan->company_id);
            }
            $companyarr_unique = array_unique($companyarr);
            $companies = Company::whereIn('id',$companyarr_unique)->get();
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname')
            ));
            // $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            // return response()->json($fulltbps); 
        }


    }

    public function IndustryGroup(Request $request){
        if($request->industrygroup == 0){
            $userarr = User::where('user_type_id',1)->pluck('id')->toArray();
            $companies = Company::whereIn('user_id',$userarr)->get();
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname')
            ));
        }else{
            $companyids = Company::where('industry_group_id', $request->industrygroup)->pluck('id')->toArray();
            $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
            $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
            $businessplans = BusinessPlan::whereIn('id',$minitbpids)->get();
            $companyarr = array();
            $companyarr_unique = array();
            foreach ($businessplans as $key => $businessplan) {
                array_push($companyarr,$businessplan->company_id);
            }
            $companyarr_unique = array_unique($companyarr);
            $companies = Company::whereIn('id',$companyarr_unique)->get();
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname')
            ));
            // $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            // return response()->json($fulltbps); 
        }


    }

    public function RegisteredCapital(Request $request){
        if($request->registeredcapital == 0){
            $userarr = User::where('user_type_id',1)->pluck('id')->toArray();
            $companies = Company::whereIn('user_id',$userarr)->get();
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname')
            ));
        }else{
            $companyids = Company::where('registeredcapitaltype', $request->registeredcapital)->pluck('id')->toArray();
            $businessplanids = BusinessPlan::whereIn('company_id', $companyids)->pluck('id')->toArray();
            $minitbpids = MiniTBP::whereNotNull('submitdate')->whereIn('business_plan_id', $businessplanids)->pluck('id')->toArray();
            // $fulltbps = FullTbp::whereIn('mini_tbp_id', $minitbpids)->get();
            $businessplans = BusinessPlan::whereIn('id',$minitbpids)->get();
            $companyarr = array();
            $companyarr_unique = array();
            foreach ($businessplans as $key => $businessplan) {
                array_push($companyarr,$businessplan->company_id);
            }
            $companyarr_unique = array_unique($companyarr);
            $companies = Company::whereIn('id',$companyarr_unique)->get();
            return response()->json(array(
                "companies" => $companies->each->append('minitbpbelong')->each->append('fullname')
            ));
        }


    }
    
}
