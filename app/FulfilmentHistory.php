<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FulfilmentHistory extends Model
{
    public function currentFulfilment(KeyResult $keyResult)
    {
        return $this->where('key_result_id', $keyResult->id)->sum('fulfilled_value');
    }
}
