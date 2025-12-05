<?php

namespace App\Policies;

use App\Enums\MediaPermissionsEnum;

class MediaPolicy extends Policy
{
    protected static string $permissionEnum = MediaPermissionsEnum::class;
}
