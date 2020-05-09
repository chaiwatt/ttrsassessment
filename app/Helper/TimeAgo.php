<?php
namespace App\Helper;

class TimeAgo
{
    public static function timeAgo($createdate){
        $timestamp = strtotime($createdate);	
		$strTime = array("วินาที", "นาที", "ชั่วโมง", "วัน", "เดือน", "ปี");
		$length = array("60","60","24","30","12","10");
		$currentTime = time();
		if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
				$diff = $diff / $length[$i];
			}
			$diff = round($diff);
			return $diff . " " . $strTime[$i];
		}
      return "โมเดลมีการ {$action_name} {$name}";
    } 
}