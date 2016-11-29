<?php

namespace App\Services;

use Carbon\Carbon;
use App\InputPeriod;

class Timeline
{
    private $inputPeriod;

    public function __construct(InputPeriod $inputPeriod)
    {
        $this->inputPeriod = $inputPeriod;
    }

    public function canInput()
    {
        return !$this->currentInputPeriod()->isEmpty();
    }

    public function currentInputPeriod()
    {
        return $this->inputPeriod->currentOne();
    }

    public function getAlertLevel()
    {
        if (!$this->canInput()) {
            return '';
        }

        $levels = [
            ['threashold' => 168, 'label' => 'info'],
            ['threashold' => 72, 'label' => 'warning'],
        ];

        $now = Carbon::now();
        $currentPeriod = $this->currentInputPeriod();
        $diff = $now->diffInHours($currentPeriod->end_at);
        foreach ($levels as $level) {
            if ($diff >= $level['threashold']) {
                return $level['label'];
            }
        }
        return 'danger';
    }
}
