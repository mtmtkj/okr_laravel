<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FulfillmentProgress extends Model
{
    /**
     * 現時点での成果の累計を返す
     *
     * @param KeyResult $keyResult
     * @return mixed
     */
    public function currentFulfillment(KeyResult $keyResult)
    {
        return $this->where('key_result_id', $keyResult->id)->sum('fulfilled_value');
    }
}
