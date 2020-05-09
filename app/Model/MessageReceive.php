<?php

namespace App\Model;

use App\Helper\TimeAgo;
use App\Model\MessageBox;
use Illuminate\Database\Eloquent\Model;

class MessageReceive extends Model
{
    protected $fillable = [];
    protected $guarded = [];

    protected $appends = ['messagebox'];
    //message_box
    public function getMessageBoxAttribute()
    {
        return MessageBox::find($this->message_box_id);
    }

    public function getTimeAgoAttribute()
    {
        return TimeAgo::timeAgo($this->created_at);
    }
}
