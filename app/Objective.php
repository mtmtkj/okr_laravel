<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $guarded = ['id'];

    public function evaluatable()
    {
        return $this->morphTo();
    }

    public function keyResults()
    {
        return $this->hasMany('App\KeyResult');
    }
}
