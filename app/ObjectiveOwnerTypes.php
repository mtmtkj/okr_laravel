<?php

namespace App;

class ObjectiveOwnerTypes
{
    /**
     * すべての Objective Owner のキーバリューのペアを返す
     *
     * @return array
     */
    public static function all()
    {
        return ['team' => 'Team', 'individual' => 'individual'];
    }
}
