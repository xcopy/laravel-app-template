<?php

namespace App\Policies;

use App\Enums\Permissions\Role;

class RolePolicy extends Policy
{
    protected static string $permissionEnum = Role::class;
}
