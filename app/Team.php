<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function individuals()
    {
        return $this->belongsToMany('App\individual');
    }

    public function objectives()
    {
        return $this->morphMany('App\Objective', 'evaluatable');
    }
}
