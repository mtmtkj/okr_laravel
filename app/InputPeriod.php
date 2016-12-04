<?php

namespace App;

use Cache;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class InputPeriod extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['start_at', 'end_at', 'created_at', 'updated_at'];
    protected static $cacheKeys = ['InputPeriod.current'];

    protected static function boot()
    {
        parent::boot();

        static::saved(self::savedListener());
    }

    private static function savedListener()
    {
        return function () {
            static::clearCache();
        };
    }

    private static function clearCache()
    {
        foreach (static::$cacheKeys as $key) {
            Cache::forget($key);
        }
    }

    /**
     * Objective Owner の値に対するラベル (先頭のみ大文字にしたもの) を返す
     *
     * @return string
     */
    public function getObjectiveOwnerTypeLabelAttribute()
    {
        return Str::ucfirst($this->attributes['objective_owner_type']);
    }

    /**
     * 現在の InputPeriod を返す
     *
     * @return InputPeriod
     */
    public function currentOne()
    {
        $cacheKey = 'InputPeriod.current';
        return Cache::get($cacheKey, function () use ($cacheKey) {
            $current = $this->current()->firstOrNew([]);
            Cache::forever($cacheKey, $current);
            return $current;
        });
    }

    /**
     * 現在の InputPeriod に絞り込む
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent(Builder $query)
    {
        return $query->where('start_at', '<', date('Y-m-d H:i:s'));
    }

    /**
     * 期限までの残り時間に応じて、info|warning|danger のいずれかを返す
     *
     * @param \Carbon\Carbon $date
     * @return string
     */
    public function getAlertLevel(Carbon $date)
    {
        if (!$this->id) {
            return '';
        }

        $levels = [
            ['threashold' => 168, 'label' => 'info'],
            ['threashold' => 72, 'label' => 'warning'],
        ];

        $diff = $date->diffInHours($this->end_at);
        foreach ($levels as $level) {
            if ($diff >= $level['threashold']) {
                return $level['label'];
            }
        }
        return 'danger';
    }
}
