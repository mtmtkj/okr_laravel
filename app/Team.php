<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Team に紐付く Individual のリストを返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function individuals()
    {
        return $this->belongsToMany('App\Individual');
    }

    /**
     * Team に紐付く Objective のリストを返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function objectives()
    {
        return $this->morphMany('App\Objective', 'ownable');
    }
}
