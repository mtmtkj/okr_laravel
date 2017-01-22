<?php

namespace App;

class OutsideOfInputPeriod implements Period
{
    /**
     * @return boolean
     * @see Period
     */
    public function canInput(): boolean
    {
        return false;
    }

    /**
     * @return string
     * @see Period
     */
    public function guideMessage(): string
    {
        return '現在入力期間ではありません。';
    }

    /**
     * @return \App\AlertLevel
     * @see Period
     */
    public function alertLevel(): AlertLevel
    {
        return new AlertLevel(AlertLevel::INFO);
    }
}
