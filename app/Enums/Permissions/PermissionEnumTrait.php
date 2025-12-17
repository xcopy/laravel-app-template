<?php

namespace App\Enums\Permissions;

trait PermissionEnumTrait
{
    /**
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }
}
