<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    protected $guarded = ['id'];

    /**
     * Individual に紐付く User を取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Individual に紐付く Team のリストを取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany('App\Team');
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
}
