<?php

namespace App\Model;

use App\User;
use App\Helper\DateConversion;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [];
    protected $guarded = [];
    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    public function getCreateatthAttribute()
    {
        return DateConversion::thaiDateTime($this->created_at,'full');
    }

    
}
