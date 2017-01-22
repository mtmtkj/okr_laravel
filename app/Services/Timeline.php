<?php

namespace App\Services;

use Cache;
use App\InputPeriod;
use App\OutsideOfInputPeriod;

class Timeline
{
    private $inputPeriod;
    protected static $cacheKeys = ['Timeline.currentPeriod'];

    public function __construct(InputPeriod $inputPeriod)
    {
        $this->inputPeriod = $inputPeriod;
    }

    public static function clearCache()
    {
        foreach (static::$cacheKeys as $key) {
            Cache::forget($key);
        }
    }

    public function currentPeriod()
    {
        $cacheKey = 'Timeline.currentPeriod';
        return Cache::get($cacheKey, function () use ($cacheKey) {
            $current = $this->currentPeriodImpl();
            Cache::forever($cacheKey, $current);
            return $current;
        });
    }

    protected function currentPeriodImpl()
    {
        $inputPeriod = $this->inputPeriod->current()->first();
        if ($inputPeriod === null) {
            return new OutsideOfInputPeriod();
        }
        return $inputPeriod;
    }

    public function canInput()
    {
        return $this->currentInputPeriod()->canInput();
    }
}
