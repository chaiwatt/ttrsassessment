<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinPinController extends Controller
{
    public function CompanyInfo($pin){
        $companyinfo = collect();
        $wsdl = 'https://rdws.rd.go.th/serviceRD3/vatserviceRD3.asmx?wsdl';
        $soapclient = new \nusoap_client($wsdl, true);
        $soapclient->soap_defencoding = 'UTF-8';
        $soapclient->decode_utf8 = false;
        $err = $soapclient->getError();
        if ($err) {
            return response()->json($companyinfo); 
        }
        $var_name = array(
                'username' => 'anonymous',
                'password' => 'anonymous',
                'TIN'   => $pin,
                'skip'   => 0
        );
        $result = $soapclient->call('Service', $var_name);
        if(!Empty($result)){
           
            $data = $result['ServiceResult'];
            if(Empty($data['vmsgerr'])){
                $titlename = $data['vtitleName']['anyType'];
                $vatid = $data['vNID']['anyType'];
                $registerdate = $data['vBusinessFirstDate']['anyType'];
                $companyname = $data['vName']['anyType'];
                $housenumber = $data['vHouseNumber']['anyType'];
                $moo = $data['vMooNumber']['anyType'];
                $soi = $data['vSoiName']['anyType'];
                $street = $data['vStreetName']['anyType'];
                $tambolname = $data['vThambol']['anyType'];
                $amphurname = $data['vAmphur']['anyType'];
                $provincename = $data['vProvince']['anyType'];
                $postalcode = $data['vPostCode']['anyType'];
                $vat = true;
                if(Empty($data['vName']['anyType'])){
                    $vat =false;
                }
                
                $_companyinfo[] = array('titlename' => $titlename, 'vatid' => $vatid, 'registerdate' => $registerdate,'companyname' => $companyname,'housenumber' => $housenumber
                ,'moo' => $moo,'soi' => $soi,'street' => $street,'tambolname' => $tambolname,'amphurname' => $amphurname
                ,'provincename' => $provincename,'postalcode' => $postalcode,'vat' => $vat);
                $companyinfo = collect($_companyinfo);
                return response()->json($companyinfo);
            }else{
                return response()->json($companyinfo);
            }
        }
    }
}
