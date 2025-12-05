<?php

namespace App\Policies;

use App\Enums\UserPermissionsEnum;

class UserPolicy extends Policy
{
    protected static string $permissionEnum = UserPermissionsEnum::class;
}
