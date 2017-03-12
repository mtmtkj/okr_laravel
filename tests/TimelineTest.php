<?php

namespace Tests;

use Mockery;
use Carbon\Carbon;
use App\InputPeriod;
use App\OutsideOfInputPeriod;
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
            $period = new InputPeriod();
            $period->id = 1;
            $period->name = 'test';
            $period->start_at = $now->copy()->subDay();
            $period->end_at = $now->copy()->addHours($diff);
        } else {
            $period = new OutsideOfInputPeriod();
        }
        $mockInputPeriod = Mockery::mock('App\InputPeriod')->makePartial();
        $mockInputPeriod->shouldReceive('current->first')->andReturn($period);

        $timeline = new Timeline($mockInputPeriod);
        $currentPeriod = $timeline->currentPeriod();
        $level = $currentPeriod->alertLevel();
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

    /**
     * 現在入力期間外である場合に、次の入力期間があれば、
     * currentPeriod() は OutsideOfInputPeriod を返し、
     * OutsideOfInputPeriod の end_at は次の InputPeriod の start_at になる
     */
    public function testEndAt()
    {
        $now = Carbon::now();
        $inputPeriod = new InputPeriod();
        $inputPeriod->id = 1;
        $inputPeriod->name = 'test';
        $inputPeriod->start_at = $now->copy()->addDay();
        $inputPeriod->end_at = $now->copy()->addDays(2);

        $mockInputPeriod = Mockery::mock('App\InputPeriod')->makePartial();
        $mockInputPeriod->shouldReceive('current->first')->andReturn(null);
        $mockInputPeriod->shouldReceive('coming->first')->andReturn($inputPeriod);

        $timeline = new Timeline($mockInputPeriod);
        $this->assertInstanceOf(OutsideOfInputPeriod::class, $timeline->currentPeriod());
        $this->assertEquals($inputPeriod->start_at, $timeline->currentPeriod()->end_at);
    }
}
