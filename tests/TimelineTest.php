<?php

namespace App\Test;

use Mockery;
use Carbon\Carbon;
use App\InputPeriod;
use App\OutsideOfPeriod;
use App\Services\Timeline;

class TimelineTest extends TestCase
{
    public function testCurrentState()
    {
        $now = Carbon::now();
        $inputPeriod = new InputPeriod();
        $inputPeriod->id = 1;
        $inputPeriod->name = 'test';
        $inputPeriod->start_at = $now->copy()->subDays(2);
        $inputPeriod->end_at = $now->copy()->subDay();

        $mockInputPeriod = Mockery::mock('App\InputPeriod')->makePartial();
        $mockInputPeriod->shouldReceive('current->first')->andReturn($inputPeriod);

        $timeline = new Timeline($mockInputPeriod);
        $this->assertEquals('test', $timeline->currentPeriod()->name);
    }

    /**
    * @dataProvider getDataForTestGetAlertLevel
    */
    public function testGetAlertLevel($diff, $expectedLevel)
    {
        if ($diff) {
            $now = Carbon::now();
            $inputPeriod = new InputPeriod();
            $inputPeriod->id = 1;
            $inputPeriod->name = 'test';
            $inputPeriod->start_at = $now->copy()->subDay();
            $inputPeriod->end_at = $now->copy()->addHours($diff);
        } else {
            $inputPeriod = new OutsideOfPeriod();
        }
        $mockInputPeriod = Mockery::mock('App\InputPeriod')->makePartial();
        $mockInputPeriod->shouldReceive('current->first')->andReturn($inputPeriod);

        $timeline = new Timeline($mockInputPeriod);
        $period = $timeline->currentPeriod();
        $level = $period->alertLevel();
        $this->assertEquals($expectedLevel, $level);
    }

    public function getDataForTestGetAlertLevel()
    {
        return [
            '十分余裕がある' => [7 * 24, 'info'],
            'そろそろ入力しないと' => [7 * 24 - 1, 'warning'],
            'そろそろ入力しないと！' => [3 * 24, 'warning'],
            '締め切り間近！！' => [3 * 24 - 1, 'danger'],
            '期間外' => [0, 'info'],
        ];
    }

    public function testGuideMessage()
    {
        $now = Carbon::now();
        $inputPeriod = new InputPeriod();
        $inputPeriod->id = 1;
        $inputPeriod->name = 'test';
        $inputPeriod->start_at = $now->copy()->subDays(2);
        $inputPeriod->end_at = $now->copy()->subDay();

        $mockInputPeriod = Mockery::mock('App\InputPeriod')->makePartial();
        $mockInputPeriod->shouldReceive('current->first')->andReturn($inputPeriod);

        $timeline = new Timeline($mockInputPeriod);

        $period = $timeline->currentPeriod();

        $guide = $period->guideMessage();

        $this->assertContains('ただいまtestの入力期間です', $guide);
    }
}
