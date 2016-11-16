<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class InputPeriod extends Model
{
    public function getEvaluateeTypeAttribute()
    {
        return Str::ucfirst($this->attributes['evaluatee_type']);
    }
}
