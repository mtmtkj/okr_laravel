<?php
declare(strict_types=1);

namespace App\Models;

class AlertLevel
{
    const INFO = 'info';
    const WARN = 'warning';
    const DANGER = 'danger';

    public function __construct($value = 0)
    {
        $self = new \ReflectionObject($this);
        $consts = $self->getConstants();
        if (!in_array($value, $consts, true)) {
            throw new InvalidArgumentException;
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
