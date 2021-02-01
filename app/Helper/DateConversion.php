<?php
namespace App\Helper;

use Carbon\Carbon;
use App\Model\ProjectStatus;

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
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
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
    public static function shortThaiDate($engdate,$case)
	{
        $strDate = $engdate;
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","01","02","03","04","05","06","07","08","09","10","11","12");
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
    public static function thaiDateTime($date)
	{
        $strYear = date("Y",strtotime($date->toDateString()))+543;
		$strMonth= date("n",strtotime($date->toDateString()));
        $strDay= date("j",strtotime($date->toDateString()));
        return $strDay.'/'.$strMonth.'/'.$strYear . ' ' . $date->format('H:i:s');
    }
    public static function thaiMonthNow()
	{
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[intval(Carbon::today()->format('m'))];
        return $strMonthThai;
    }
    public static function thaiYearNow()
	{
        return Carbon::today()->format('yy')+543;;
    }

    public static function addExtraDay($minitbpid,$flowid){
        $projectstatus = ProjectStatus::where('mini_tbp_id',$minitbpid)->where('project_flow_id',$flowid)->first();
        $enddate = Carbon::createFromFormat('Y-m-d', $projectstatus->enddate);
        $left = Carbon::parse(Carbon::now())->DiffInDays($enddate, false);
        if($left < 0){
            $extraday = $left*(-1);
            $projectstatuses = ProjectStatus::where('mini_tbp_id',$minitbpid)->where('id','>',$projectstatus->id)->get();
            foreach ($projectstatuses as $key => $projectstatus) {
                $projectstatus->update([
                    'startdate' => Carbon::createFromFormat('Y-m-d', $projectstatus->startdate)->addDays($extraday),
                    'enddate' => Carbon::createFromFormat('Y-m-d', $projectstatus->enddate)->addDays($extraday)
                ]);
            }
        }
    }
}