<?php

namespace App\Models;

use App\Policies\PermissionPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Spatie\Permission\Models\Permission as BasePermission;

#[UsePolicy(PermissionPolicy::class)]
class Permission extends BasePermission
{
}
