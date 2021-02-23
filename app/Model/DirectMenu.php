<?php

namespace App\Model;

use App\Model\DirectMenu;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class DirectMenu extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    public function getViewdateAttribute(){
        $directmenu = DirectMenu::find($this->id);
        return DateConversion::thaiDateTime($directmenu->updated_at);
    } 
}
