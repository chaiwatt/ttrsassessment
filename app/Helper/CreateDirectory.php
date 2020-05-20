<?php
namespace App\Helper;

class CreateDirectory
{
    public static function createDirectory($directory){
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        return $directory;
    } 
}

