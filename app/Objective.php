<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $guarded = ['id'];

    public function evaluatable()
    {
        $this->morphTo();
    }
}
