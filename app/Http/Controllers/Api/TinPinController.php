<?php

namespace App\Http\Controllers\Api;

use App\Model\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TinPinController extends Controller
{
    public function CompanyInfo(Request $request){
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
                'TIN'   => $request->vatid,
                'skip'   => 0
        );
        $result = $soapclient->call('Service', $var_name);
        if(!Empty($result)){
           
            $data = $result['ServiceResult'];
            if(Empty($data['vmsgerr'])){
                $vatid = $data['vNID']['anyType'];
                $registerdate = $data['vBusinessFirstDate']['anyType'];
                $title = $data['vtitleName']['anyType'];
                $name = $data['vName']['anyType'];
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

                $company = Company::where('vatno',$request->vatid)->first();
                $exist = 'n';
                if(!Empty($company)){
                    $exist ='y';
                }
                
                $_companyinfo[] = array('vatid' => $vatid, 'registerdate' => $registerdate,'title' => $title,'name' => $name,'housenumber' => $housenumber
                ,'moo' => $moo,'soi' => $soi,'street' => $street,'tambolname' => $tambolname,'amphurname' => $amphurname
                ,'provincename' => $provincename,'postalcode' => $postalcode,'vat' => $vat,'exist' => $exist);
                $companyinfo = collect($_companyinfo);
                return response()->json($companyinfo);
            }else{
                return response()->json($companyinfo);
            }
        }
    }
}