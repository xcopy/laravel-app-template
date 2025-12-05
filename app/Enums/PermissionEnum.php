<?php

namespace App\Enums;

use BackedEnum;

interface PermissionEnum extends BackedEnum
{
    public static function getPermissionNames(): array;
}
