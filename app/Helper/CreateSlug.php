<?php
namespace App\Helper;

use Illuminate\Support\Facades\DB;

class CreateSlug
{
    public static function createslug($string){
        $raw = preg_replace('!\s+!', ' ', $string);
        $raw = preg_replace('/[^A-Za-z0-9ก-๙\-]/u', '-',str_replace('&', '-and-', $raw));
        $output = strlen($raw) > 20 ? substr($raw,0,20) : $raw;
        return $output;
    } 
}

