<?php
namespace App\Helper;

class LogAction
{
    public static function logAction($name,$action){
        $action_name = '';
        if($action == 'created'){
            $action_name = 'เพิ่ม';
        }elseif ($action == 'updated'){
            $action_name = 'แก้ไข';
        }elseif ($action == 'deleted'){
            $action_name = 'ลบ';
        }

      return "โมเดลมีการ {$action_name} {$name}";
    } 
}