<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function contacts(){
        return $this->hasMany(Contact::class)->orderBy('title', 'Asc');
    }

    public function schedules(){
        return $this->hasMany(Message::class)->where('user_id', Auth::user()->id);
    }

    public function units(){
        return $this->hasMany(UnitPurchase::class);
    }

    function messages(){
        return $this->hasMany(Message::class);
    }
}
