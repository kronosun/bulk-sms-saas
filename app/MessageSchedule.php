<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageSchedule extends Model
{
    public function message(){
        return $this->belongsTo(Message::class);
    }

    public function contact(){
        return $this->belongsTo(Contact::class);
    }
}
