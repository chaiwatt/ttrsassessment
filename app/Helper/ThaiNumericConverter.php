<?php
namespace App\Helper;

class ThaiNumericConverter
{
    public static function toThaiNumeric($v){
        return str_replace(
            array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
            array('๐', '๑', '๒', '๓', '๔', '๕', '๖', '๗', '๘', '๙'),
            $v
        );
    } 
}
