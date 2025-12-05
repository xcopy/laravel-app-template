<?php

namespace App\Models;

use App\Policies\RolePolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Spatie\Permission\Models\Role as BaseRole;

#[UsePolicy(RolePolicy::class)]
class Role extends BaseRole
{
}
