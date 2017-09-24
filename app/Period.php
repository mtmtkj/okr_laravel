<?php
declare(strict_types=1);

namespace App;

interface Period
{
    /**
     * @return string
     */
    public function guideMessage(): string;

    /**
     * @return \App\AlertLevel
     */
    public function alertLevel(): AlertLevel;

    /**
     * 入力可能かどうかを返す
     *
     * @return bool
     */
    public function canInput(): bool;
}
