<?php
namespace App\Helper;

use Illuminate\Support\Facades\DB;

class Crop
{
    public static function crop($isvertical,$path,$fname,$img,$width,$height,$offset){
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if($isvertical == true){
            $_width = $width*$offset; 
            $_height = $height*$offset; 
            $img->height() > $img->width() ? $_width=null : $_height=null;
            $img->resize($_width, $_height, function ($constraint) {
                $constraint->aspectRatio();
            })->crop($width, $height)->save($path.$fname);
        }else{
            $_width = $width*$offset; 
            $_height = $height*$offset; 
            $img->resize(null, $_height, function ($constraint) {
                $constraint->aspectRatio();
            })->crop($width, $height)->save($path.$fname);
        }
        return;
    }
}

