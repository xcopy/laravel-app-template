<?php

namespace App\Enums;

trait PermissionEnumTrait
{
    /**
     * @return array<string>
     */
    public static function getPermissionNames(): array
    {
        return array_column(static::cases(), 'value');
    }
}
