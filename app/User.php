<?php

namespace App;

use Illuminate\Auth\Events\Login;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Team に紐付く Individual を返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function individual()
    {
        return $this->hasOne('App\Individual');
    }

    public function handleLoginEvent(Login $event)
    {
        $event->user->api_token = str_random(60);
        $event->user->save();
    }
}
