<?php

namespace App\Policies;

use App\Enums\Permissions\Media;

class MediaPolicy extends Policy
{
    protected static string $permissionEnum = Media::class;
}
