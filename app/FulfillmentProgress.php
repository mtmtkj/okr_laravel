<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FulfillmentProgress extends Model
{
    public function currentFulfillment(KeyResult $keyResult)
    {
        return $this->where('key_result_id', $keyResult->id)->sum('fulfilled_value');
    }
}
