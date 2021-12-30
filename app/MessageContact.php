<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageContact extends Model
{
    public $table = 'contact_message';

     public function message(){
        return $this->belongsTo(Message::class);
    }

    public function Contact(){
        return $this->belongsTo(Contact::class);
    }
}
