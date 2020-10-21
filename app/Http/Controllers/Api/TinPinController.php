<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Company;
use Illuminate\Http\Request;
use App\Helper\DateConversion;
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
                $registerdateth = DateConversion::engToThaiDate(str_replace('/','-',$registerdate));
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
                
                $_companyinfo[] = array('vatid' => $vatid, 'registerdate' => $registerdate, 'registerdateth' => $registerdateth,'title' => $title,'name' => $name,'housenumber' => $housenumber
                ,'moo' => $moo,'soi' => $soi,'street' => $street,'tambolname' => $tambolname,'amphurname' => $amphurname
                ,'provincename' => $provincename,'postalcode' => $postalcode,'vat' => $vat,'exist' => $exist);
                $companyinfo = collect($_companyinfo);
                return response()->json($companyinfo);
            }else{
                if(strlen($request->vatid) != 13){ 
                    return response()->json($companyinfo);
                }else{
                    for($i=0, $sum=0; $i<12;$i++){
                        $sum += (int)( $request->vatid[$i] ) * (13-$i);
                    }
                    if((11-($sum%11))%10 == (int)($request->vatid[12] ) ){
                        $check = User::where('hid' , $request->vatid)->first();
                        if( !empty($check) ){
                            $_companyinfo[] = array('vatid' => $request->vatid, 'registerdate' => '', 'registerdateth' => '','title' => '','name' => 'บัตรประจำตัวประชาชน','housenumber' => ''
                                            ,'moo' => '','soi' => '','street' => '','tambolname' => '','amphurname' => ''
                                            ,'provincename' => '','postalcode' => '','vat' => '','exist' => 'y');
                            $companyinfo = collect($_companyinfo);
                            return response()->json($companyinfo);
                        }
                        else{
                            $_companyinfo[] = array('vatid' => $request->vatid, 'registerdate' => '', 'registerdateth' => '','title' => '','name' => 'บัตรประจำตัวประชาชน','housenumber' => ''
                                            ,'moo' => '','soi' => '','street' => '','tambolname' => '','amphurname' => ''
                                            ,'provincename' => '','postalcode' => '','vat' => '','exist' => 'n');
                            $companyinfo = collect($_companyinfo);
                            return response()->json($companyinfo);
                        }
                    }
                    else{
                        return response()->json($companyinfo);
                    }
                }
            }
        }
    }

    public function CheckHid($hid){
        $arrresult = array();
        if(strlen( $hid ) != 13){ 
            $arrresult[] = array(
                'message' => 'ผิดพลาด ไม่สามารถใช้รหัสบัตรประชาชนนี้ได้ เนื่องจากรูปแบบไม่ถูกต้อง', 
                'success' => false
            );
        }
        else{
            for($i=0, $sum=0; $i<12;$i++){
                $sum += (int)( $hid[$i] ) * (13-$i);
            }
            if((11-($sum%11))%10 == (int)($hid[12] ) ){
                $check = User::where('hid' , $hid)->first();
                if( !empty($check) ){
                    $arrresult[] = array(
                        'message' => 'ผิดพลาด ไม่สามารถใช้รหัสบัตรประชาชนนี้ได้ เนื่องจากมีอยู่ในระบบแล้ว', 
                        'success' => false
                    );
                }
                else{
                    $arrresult[] = array(
                        'message' => 'สามารถใช้รหัสบัตรประชาชนนี้ได้', 
                        'success' => true
                    );
                }
            }
            else{
                $arrresult[] = array(
                    'message' => 'ผิดพลาด ไม่สามารถใช้รหัสบัตรประชาชนนี้ได้ เนื่องจากรูปแบบไม่ถูกต้อง', 
                    'success' => false
                );
            }
        }
        return response()->json($arrresult);  
    } 
}
