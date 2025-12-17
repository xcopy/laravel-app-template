<?php

namespace App\Enums\Permissions;

enum Permission: string implements PermissionEnum
{
    use PermissionEnumTrait;

    case VIEW = 'view permission';
    case VIEW_ANY = 'view any permission';
    case CREATE = 'create permission';
    case UPDATE = 'update permission';
    case DELETE = 'delete permission';
    case RESTORE = 'restore permission';
    case FORCE_DELETE = 'force delete permission';
}
