<?php

namespace App\Policies;

use App\Enums\Permissions\Permission;

class PermissionPolicy extends Policy
{
    protected static string $permissionEnum = Permission::class;
}
