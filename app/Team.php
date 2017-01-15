<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = ['id'];

    /**
     * Team に紐付く Individual のリストを返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function individuals()
    {
        return $this->belongsToMany('App\Individual')->with('user');
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
