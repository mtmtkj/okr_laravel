<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $guarded = ['id'];

    public function ownable()
    {
        return $this->morphTo();
    }

    public function keyResults()
    {
        return $this->hasMany('App\KeyResult');
    }
}
