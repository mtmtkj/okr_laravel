<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyResult extends Model
{
    protected $guarded = ['id'];
    private $fulfilled;

    public function objective()
    {
        return $this->belongsTo('App\Objective');
    }

    public function fulfillment_progresses()
    {
        return $this->hasMany('App\FulfillmentProgress');
    }

    public function currentFulfillmentPercentage()
    {
        if ($this->fulfilled != null) {
            return $this->fulfilled;
        }
        $relation = $this->hasMany('App\FulfillmentProgress');
        $fulfillmentProgress = $relation->getRelated();

        $fulfilled = $fulfillmentProgress->currentFulfillment($this);
        $this->fulfilled = round($fulfilled / $this->target_value * 100, 1);

        return $this->fulfilled;
    }
}
