<?php
namespace App\Helper;

use App\Model\GeneralInfo;

class SMS
{
    private $api_url   = 'http://www.thsms.com/api/rest';
   
    public static function credit(){
        $sms = new thsms();
        $generalinfo = GeneralInfo::first();
        $sms->username   = $generalinfo->thsmsuser;
        $sms->password   = $generalinfo->thsmspass;
        return $sms->getCredit();
    }

    public static function send($phone,$message){
        $sms = new thsms();
        $generalinfo = GeneralInfo::first();
        $sms->username   = $generalinfo->thsmsuser;
        $sms->password   = $generalinfo->thsmspass;
        return $sms->send( 'OTP', $phone, $message);
    }

}

class thsms
{
     var $api_url   = 'http://www.thsms.com/api/rest';
     var $username  = null;
     var $password  = null;
 
    public function getCredit()
    {
        $params['method']   = 'credit';
        $params['username'] = $this->username;
        $params['password'] = $this->password;
 
        $result = $this->curl( $params);
 
        $xml = @simplexml_load_string( $result);
 
        if (!is_object($xml))
        {
            return array( FALSE, 'Respond error');
 
        } else {
 
            if ($xml->credit->status == 'success')
            {
                return array( TRUE, $xml->credit->amount);
            } else {
                return array( FALSE, $xml->credit->message);
            }
        }
    }
 
    public function send( $from='OTP', $to=null, $message=null)
    {
        $params['method']   = 'send';
        $params['username'] = $this->username;
        $params['password'] = $this->password;
 
        $params['from']     = $from;
        $params['to']       = $to;
        $params['message']  = $message;
 
        if (is_null( $params['to']) || is_null( $params['message']))
        {
            return FALSE;
        }
 
        $result = $this->curl( $params);
        $xml = @simplexml_load_string( $result);
        if (!is_object($xml))
        {
            return array( FALSE, 'Respond error');
        } else {
            if ($xml->send->status == 'success')
            {
                return array( TRUE, $xml->send->uuid);
            } else {
                return array( FALSE, $xml->send->message);
            }
        }
    }
     
    private function curl( $params=array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
        $response  = curl_exec($ch);
        $lastError = curl_error($ch);
        $lastReq = curl_getinfo($ch);
        curl_close($ch);
 
        return $response;
    }
}