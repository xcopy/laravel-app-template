<?php

namespace App\Enums\Permissions;

use BackedEnum;

interface PermissionEnum extends BackedEnum
{
    public static function values(): array;
}
