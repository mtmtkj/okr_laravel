<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function individuals()
    {
        return $this->belongsToMany('App\individual');
    }
}
