<?php

namespace App;

use Cache;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Services\Timeline;

class InputPeriod extends Model implements Period
{
    protected $guarded = ['id'];
    protected $dates = ['start_at', 'end_at', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::saved(self::savedListener());
    }

    private static function savedListener()
    {
        return function () {
            Timeline::clearCache();
        };
    }

    /**
     * @return string
     */
    public function getObjectiveOwnerTypeLabelAttribute()
    {
        return Str::ucfirst($this->attributes['objective_owner_type']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent($query)
    {
        $now = date('Y-m-d H:i:s');
        return $query->where('start_at', '<', $now)
            ->where('end_at', '>', $now);
    }

    public function scopeComing($query)
    {
        $now = date('Y-m-d H:i:s');
        return $query->where('start_at', '>', $now);
    }

    /**
     * @return bool
     */
    public function canInput(): bool
    {
        return ($this->id !== null);
    }

    /**
     * @return string
     */
    public function guideMessage(): string
    {
        return sprintf('ただいま%sの入力期間です (%s)。', $this->name, $this->deadlineMessage());
    }

    private function deadlineMessage()
    {
        if ($this->alertLevel() !== 'danger') {
            return sprintf('%sまで！', $this->end_at->format('Y-m-d H:i:s'));
        }
        return sprintf('残り%d時間！！', $this->remainingHours($this->end_at));
    }

    private function remainingHours($endAt)
    {
        $now = Carbon::now();
        $diff = $now->diffInHours($this->end_at);

        return $diff;
    }

    /**
     * @return \App\AlertLevel
     */
    public function alertLevel(): AlertLevel
    {
        $levels = [
            ['threashold' => 168, 'level' => AlertLevel::INFO],
            ['threashold' => 72, 'level' => AlertLevel::WARN],
        ];

        $diff = $this->remainingHours($this->end_at);
        foreach ($levels as $level) {
            if ($diff >= $level['threashold']) {
                return new AlertLevel($level['level']);
            }
        }
        return new AlertLevel(AlertLevel::DANGER);
    }
}
