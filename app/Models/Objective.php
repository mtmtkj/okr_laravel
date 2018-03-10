<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $guarded = ['id'];

    /**
     * Objective を持てるエンティティ (Team や Individual) のインスタンスを返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function ownable()
    {
        return $this->morphTo();
    }

    /**
     * Objective に紐付く KeyResult のリストを返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keyResults()
    {
        return $this->hasMany('App\Models\KeyResult');
    }
}
