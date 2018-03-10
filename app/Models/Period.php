<?php
declare(strict_types=1);

namespace App\Models;

interface Period
{
    /**
     * @return string
     */
    public function guideMessage(): string;

    /**
     * @return \App\Models\AlertLevel
     */
    public function alertLevel(): AlertLevel;

    /**
     * 入力可能かどうかを返す
     *
     * @return boolean
     */
    public function canInput(): boolean;
}
