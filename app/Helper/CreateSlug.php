<?php
namespace App\Helper;

use Illuminate\Support\Facades\DB;

class CreateSlug
{
    public static function createslug($string){
        return preg_replace('/[^A-Za-z0-9ก-๙\-]/u', '-',str_replace('&', '-and-', $string));
    } 
}

