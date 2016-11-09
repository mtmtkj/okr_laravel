<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }
}
