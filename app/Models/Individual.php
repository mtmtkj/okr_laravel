<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Individual extends Model
{
    protected $guarded = ['id'];

    /**
     * Individual に紐付く User を返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Individual に紐付く Objective と KeyResult のリストを返す
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function objectives()
    {
        return $this->morphMany('App\Models\Objective', 'ownable')->with('keyResults');
    }

    /**
     * prevent from manipulating many-to-many relationship
     *
     * @return mixed
     */
    public function getOrganizationAttribute()
    {
        return $this->organizations()->first();
    }

    public function saveOrganization(Organization $organization)
    {
        return $this->organizations()->save($organization);
    }

    private function organizations()
    {
        return $this->belongsToMany('App\Models\Organization')->withTimestamps();
    }

    /**
     * Individual に紐付く Team のリストを取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team')->withTimestamps();
    }

    /**
     * Individual が指定された Team に属しているかどうかを返す
     *
     * @param Team $aTeam
     * @return boolean
     */
    public function belongsToTeam(Team $aTeam)
    {
        foreach ($this->teams as $team) {
            if ($team->id === $aTeam->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * 名前はUserモデルにあるので委譲する
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->user->name;
    }

    /**
     * Individual に紐付く Objective 経由 で、KeyResult のリストを返す
     *
     * @return array
     */
    public function keyResults()
    {
        $keyResults = [];
        foreach ($this->objectives as $objective) {
            foreach ($objective->keyResults as $keyResult) {
                $keyResult->objective = $objective;
                $keyResults[] = $keyResult;
            }
        }
        return $keyResults;
    }
}
