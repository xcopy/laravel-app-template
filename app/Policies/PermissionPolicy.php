<?php

namespace App\Policies;

use App\Enums\PermissionPermissionsEnum;

class PermissionPolicy extends Policy
{
    protected static string $permissionEnum = PermissionPermissionsEnum::class;
}
