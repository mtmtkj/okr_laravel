<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyResult extends Model
{
    protected $guarded = ['id'];

    public function objective()
    {
        return $this->belongsTo('App\Objective');
    }
}
