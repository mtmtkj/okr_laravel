<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class InputPeriod extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['start_at', 'end_at', 'created_at', 'updated_at'];

    public function getObjectiveOwnerTypeLabelAttribute()
    {
        return Str::ucfirst($this->attributes['objective_owner_type']);
    }

    public function scopeCurrent($query)
    {
        return $query->where('start_at', '<', date('Y-m-d H:i:s'));
    }

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
