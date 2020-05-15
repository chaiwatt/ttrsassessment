<?php
namespace App\Helper;

use Carbon\Carbon;

class DateConversion
{
    public static function thaiToEngDate($thaidate){
        $tmp = explode("/", $thaidate);
        return ((int)$tmp[2]-543) . "-" . $tmp[1] . "-" .$tmp[0];
    }

    public static function  engToThaiDate($engdate){
        $tmp = explode("-", $engdate);
        $datethai = ((int)$tmp[0]+543) . "-" . $tmp[1] . "-" . $tmp[2];
        return Carbon::createFromFormat('Y-m-d', $datethai)->format('d/m/Y');
    }
    public static function thaiDate($engdate,$case)
	{
        $strDate = $engdate;
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน.","พฤษภาคม","มิถุนายน","กรฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        if($case == 'full'){
            return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
        }else if ($case == 'dmy'){
            return "$strDay $strMonthThai $strYear";
        }else if ($case == 'd'){
            return $strDay;
        }else if ($case == 'm'){
            return $strMonthThai;
        }else if ($case == 'y'){
            return $strYear;
        }
	}
}