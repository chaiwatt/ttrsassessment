<?php

namespace App\Model;

use App\Model\Prefix;
use App\Model\MinitbpSignature;
use Illuminate\Database\Eloquent\Model;

class AuthorizedDirector extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    protected $appends = ['prefix'];
    
    public function getPrefixAttribute()
    {
        return Prefix::find($this->prefix_id);
    }

  
}
