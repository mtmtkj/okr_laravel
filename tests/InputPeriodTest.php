<?php

namespace App\Test;

use Carbon\Carbon;
use App\InputPeriod;

class InputPeriodTest extends TestCase
{
    /**
    * @dataProvider getDataForTestGetAlertLevel
    */
    public function testGetAlertLevel($diff, $expectedLevel)
    {
        $now = Carbon::now();
        $inputPeriod = new InputPeriod();
        $inputPeriod->id = 1;
        $inputPeriod->name = 'test';
        $inputPeriod->start_at = $now->copy()->subDay();
        $inputPeriod->end_at = $now->copy()->addHours($diff);

        $level = $inputPeriod->getAlertLevel($now);
        $this->assertEquals($expectedLevel, $level);
    }

    public function getDataForTestGetAlertLevel()
    {
        return [
            '十分余裕がある' => [7 * 24, 'info'],
            'そろそろ入力しないと' => [7 * 24 - 1, 'warning'],
            'そろそろ入力しないと！' => [3 * 24, 'warning'],
            '締め切り間近！！' => [3 * 24 - 1, 'danger'],
        ];
    }
}
