<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo('App\Objective');
    }

    /**
     * KeyResult に紐付く FulfillmentProgress を取得する
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fulfillment_progresses()
    {
        return $this->hasMany('App\FulfillmentProgress');
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
        $relation = $this->hasMany('App\FulfillmentProgress');
        $fulfillmentProgress = $relation->getRelated();

        $fulfilled = $fulfillmentProgress->currentFulfillment($this);
        $this->fulfilled = round($fulfilled / $this->target_value * 100, 1);

        return $this->fulfilled;
    }
}
