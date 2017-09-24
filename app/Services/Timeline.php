<?php

namespace App\Services;

use Cache;
use Carbon\Carbon;
use App\InputPeriod;
use App\OutsideOfInputPeriod;

class Timeline
{
    /**
     * @var  InputPeriod  ORM
     */
    private $inputPeriodORM;

    /**
     * @var  array  キャッシュをクリアするために使う
     */
    protected static $cacheKeys = ['Timeline.currentPeriod'];

    /**
     * @param  InputPeriod  $inputPeriodORM
     */
    public function __construct(InputPeriod $inputPeriodORM)
    {
        $this->inputPeriodORM = $inputPeriodORM;
    }

    /**
     * キャッシュをクリアする
     */
    public static function clearCache()
    {
        foreach (static::$cacheKeys as $key) {
            Cache::forget($key);
        }
    }

    /**
     * 現在の期間を返す (チームの入力期間、個人の入力期間、入力期間外、etc.)
     *
     * @return Period
     */
    public function currentPeriod()
    {
        $cacheKey = 'Timeline.currentPeriod';
        return Cache::get($cacheKey, function () use ($cacheKey) {
            $current = $this->currentPeriodImpl();
            $minutesLeft = ($current->end_at)
                ? floor(($current->end_at->timestamp - time()) / 60)
                : 0; // forever
            Cache::put($cacheKey, $current, $minutesLeft);
            return $current;
        });
    }

    /**
     * 入力期間内であれば InputPeriod を返し、期間外であれば OutsideOfInputPeriod を返す
     *
     * @return Period
     */
    protected function currentPeriodImpl()
    {
        $inputPeriod = $this->inputPeriodORM->current()->first();
        if ($inputPeriod !== null) {
            return $inputPeriod;
        }
        $period = new OutsideOfInputPeriod();
        $next = $this->inputPeriodORM->coming()->first();
        if ($next !== null) {
            $period->end_at = $next->start_at;
        }
        return $period;
    }

    /**
     * 入力可能かどうかを返す (現在の期間に対し委譲する)
     *
     * @return bool
     */
    public function canInput(): bool
    {
        return $this->currentPeriod()->canInput();
    }
}
