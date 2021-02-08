<?php

namespace App\Http\Controllers;

use App\Model\SoundDexApi;
use Illuminate\Http\Request;

class DashboardAdminSearchSounddexController extends Controller
{
    public function Index(){
        $randomapi = SoundDexApi::inRandomOrder()->first();
        $curl = curl_init();
        $search = "ลำพูน";
        curl_setopt_array($curl, array(
            //CURLOPT_URL => "https://api.aiforthai.in.th/soundex?word=".$search."&model=personname",
            CURLOPT_URL => "https://api.aiforthai.in.th/soundex?word=".$search."&model=royin",
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
            return "cURL Error #:" . $err;
        } else {
            $objs = json_decode($response);
            foreach ($objs->words as $obj) {
                echo $obj->word . '<br>';
            }
            // return $objs->words;
        }
    }
    public function Search(){
        $randomapi = SoundDexApi::inRandomOrder()->first();
        $curl = curl_init();
        $search = "สมชาย";
        curl_setopt_array($curl, array(
            //CURLOPT_URL => "https://api.aiforthai.in.th/soundex?word=".$search."&model=personname",
            CURLOPT_URL => "https://api.aiforthai.in.th/soundex?word=".$search."&model=royin",
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
            return "cURL Error #:" . $err;
        } else {
            $objs = json_decode($response);
            foreach ($objs->words as $obj) {
                echo $obj->word . '<br>';
            }
            // return $objs->words;
        }
    }
}
