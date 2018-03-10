<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class KeyResult extends Model
{
    protected $guarded = ['id'];

    /**
     * @var float 成果達成率
     */
    private $fulfilled;

    /**
     * KeyResult に紐付く Objective を取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function objective()
    {
        return $this->belongsTo('App\Models\Objective');
    }

    /**
     * KeyResult に紐付く FulfillmentProgress を取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fulfillment_progresses()
    {
        return $this->hasMany('App\Models\FulfillmentProgress');
    }

    /**
     * 現在の成果達成率をパーセント (小数点以下第一位まで) で返す
     *
     * @return float
     */
    public function currentFulfillmentPercentage()
    {
        if ($this->fulfilled !== null) {
            return $this->fulfilled;
        }
        $relation = $this->hasMany('App\Models\FulfillmentProgress');
        $fulfillmentProgress = $relation->getRelated();

        $fulfilled = $fulfillmentProgress->currentFulfillment($this);
        $this->fulfilled = round($fulfilled / $this->target_value * 100, 1);

        return $this->fulfilled;
    }

    public function scopeBelongsToTeamsOfIndividual(Builder $query, Individual $individual)
    {
        return $query->whereHas('objective', function ($query) use ($individual) {
            $query->where('ownable_type', 'App\Models\Team')
                ->whereIn('ownable_id', $individual->teams->map(function ($team) {
                    return $team->id;
                }))
            ;
        });
    }
}
