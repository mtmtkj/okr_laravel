<?php

namespace App;

use Cache;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

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

    public function getObjectiveOwnerTypeLabelAttribute()
    {
        return Str::ucfirst($this->attributes['objective_owner_type']);
    }

    public function currentOne()
    {
        $cacheKey = 'InputPeriod.current';
        return Cache::get($cacheKey, function () use ($cacheKey) {
            $current = $this->current()->firstOrNew([]);
            Cache::forever($cacheKey, $current);
            return $current;
        });
    }

    public function scopeCurrent($query)
    {
        return $query->where('start_at', '<', date('Y-m-d H:i:s'));
    }

    public function isEmpty()
    {
        return ($this->id === null);
    }
}
