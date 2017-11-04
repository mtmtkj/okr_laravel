<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $guarded = ['id'];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
