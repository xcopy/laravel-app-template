<?php

namespace App\Policies;

use App\Enums\Permissions\User;

class UserPolicy extends Policy
{
    protected static string $permissionEnum = User::class;
}
