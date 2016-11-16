<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class InputPeriod extends Model
{
    protected $guarded = ['id'];

    public function getEvaluateeTypeLabelAttribute()
    {
        return Str::ucfirst($this->attributes['evaluatee_type']);
    }
}
