<?php

namespace App;

class OutsideOfPeriod implements Period
{
    public function canInput()
    {
        return false;
    }

    public function guideMessage(): string
    {
        return '現在入力期間ではありません。';
    }

    public function alertLevel(): AlertLevel
    {
        return new AlertLevel(AlertLevel::INFO);
    }
}
