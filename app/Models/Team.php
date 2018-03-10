<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        return $this->belongsToMany('App\Models\Individual')->withTimestamps()->with('user');
    }

    /**
     * Team に紐付く Objective のリストを返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function objectives()
    {
        return $this->morphMany('App\Models\Objective', 'ownable');
    }

    public function scopeWithJoined(Builder $query, $individualId)
    {
        $query->select('teams.*')
            ->selectRaw('CASE WHEN individual_team.individual_id THEN true ELSE false END as joined')
            ->leftJoin('individual_team', function ($join) use ($individualId) {
                $join->on('individual_team.team_id', 'teams.id')
                ->where('individual_team.individual_id', $individualId);
            })
        ;
    }
}
