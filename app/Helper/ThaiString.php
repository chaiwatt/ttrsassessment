<?php
namespace App\Helper;

use Illuminate\Support\Facades\DB;

class ThaiString
{

    public static function splitText($string,$len)
    {
        $myArray = explode('|', $string);
        $new_string = "";
        $tmp_string = "";
        $i=0;
        foreach($myArray as $key => $word){
            $tmp_string .= $word;
            $strlen =  getStrLenTH($tmp_string);
            if($strlen > $len ){
                $tmp_string  = "";
                    $new_string .=  $word . '<br>';
                $i++;
               
            }else{
                $new_string .= $word;
            }
        }
        $check = substr($new_string, -5);
        if($check  == '<br>'){
            return (substr($new_string, 0, -4));
        }
        else{
            return ($new_string);
        }
    }

    public static function getStrLenTH($string)
    {
        $array = getMBStrSplit($string);
        $count = 0;
        foreach($array as $value)
        {
            $ascii = ord(iconv("UTF-8", "TIS-620", $value ));
            
            if( !( $ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 )) )
            {
                $count += 1;
            }
        }
        return $count;
    }

    function getMBStrSplit($string, $split_length = 1){
        mb_internal_encoding('UTF-8');
        mb_regex_encoding('UTF-8'); 
        
        $split_length = ($split_length <= 0) ? 1 : $split_length;
        $mb_strlen = mb_strlen($string, 'utf-8');
        $array = array();
        $i = 0; 
        
        while($i < $mb_strlen)
        {
            $array[] = mb_substr($string, $i, $split_length);
            $i = $i+$split_length;
        }  
        return $array;
    }
}

