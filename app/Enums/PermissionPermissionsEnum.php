<?php

namespace App\Enums;

enum PermissionPermissionsEnum: string implements PermissionEnum
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
