<?php

namespace App\Policies;

use App\Enums\RolePermissionsEnum;

class RolePolicy extends Policy
{
    protected static string $permissionEnum = RolePermissionsEnum::class;
}
