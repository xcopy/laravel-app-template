<?php

namespace App\Enums\Permissions;

enum Role: string implements PermissionEnum
{
    use PermissionEnumTrait;

    case VIEW = 'view role';
    case VIEW_ANY = 'view any role';
    case CREATE = 'create role';
    case UPDATE = 'update role';
    case DELETE = 'delete role';
    case RESTORE = 'restore role';
    case FORCE_DELETE = 'force delete role';
}
